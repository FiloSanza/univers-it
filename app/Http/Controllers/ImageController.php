<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private const IMG_LOCAL_STORAGE_PATH = 'public/uploads/imgs/'; 

    /**
     * Saves an image in the storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $id = ImageController::persist($request->img);

        return $id 
            ? Response('Success.', 200)
            : Response('Error.', 500);
    }

    /**
     * Returns the queried image from storage.
     * 
     * @param int $id of the requested image.
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function get(int $id)
    {
        if ($image = Image::where('id', $id)->first()) {
            $response = Storage::response(ImageController::IMG_LOCAL_STORAGE_PATH.'/'.$image->storage_path);
            $response->headers->set('Cache-Control', 'public, max-age=86400');
            return $response;
        }

        return Response('Not found.', 404);
    }

    /**
     * Save an image to the storage.
     * 
     * @param mixed $img image that needs to be saved.
     * @param int $depth this function won't save and object if the generated name is already used, it will retry until depth > 0.
     * @return string|null the id of the persisted entity or null if there have been a problem.
     */
    public static function persist(mixed $img, int $depth = 4)
    {
        if ($depth === 0) {
            return null;
        }

        $filename_raw = hash('sha256', time().Str::random(16 * $depth));
        $extension = $img->extension();
        $filename = $filename_raw.'.'.$extension;

        if (Image::where('storage_path', $filename)->first() !== null) {
            // The generated name is already used in the storage, call again `persist`
            // to take advantage of the name randomization.
            return ImageController::persist($img, $depth-1);
        }

        Storage::disk('local')->put(ImageController::IMG_LOCAL_STORAGE_PATH.'/'.$filename, file_get_contents($img));
        
        $image = new Image();
        $image->storage_path = $filename;
        $image->save();
        
        // Return the id of the stored object.
        return $image->id;
    }
}
