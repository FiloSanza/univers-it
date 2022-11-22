<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private const IMG_LOCAL_STORAGE_PATH = 'pubilc/uploads/imgs/'; 

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

        return ImageController::persist($request->name, $request->img);
    }

    /**
     * Returns the queried image from storage.
     * 
     * @param string $id of the requested image.
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function get(string $id)
    {
        // TODO: Validate
        if ($image = Image::where('id', $id)->first()) {
            $response = Storage::response($image->storage_path);
            $response->headers->set('Cache-Control', 'public, max-age=86400');
            return $response;
        }

        return Response('Not found.', 404);
    }

    /**
     * Save an image to the storage.
     * 
     * @param string $name name of the uploaded file.
     * @param mixed $img image that needs to be saved.
     * @param int $depth this function won't save and object if the generated name is already used, it will retry until depth > 0.
     * @return \Illuminate\Http\Response HTTP 200 with the saved object id on success. HTTP 500 if the function fails to generate the file name.
     */
    public static function persist(string $name, mixed $img, int $depth = 4)
    {
        if ($depth === 0) {
            return Response('Invalid filename.', 500);
        }

        $filename_raw = hash('sha256', time().$name.Str::random(16 * $depth));
        $extension = $img->extension();
        $filename = $filename_raw.'.'.$extension;

        // TODO: Only to see how the name is generated, will crash the app.
        dd($filename);

        if (Image::where('storage_path', $filename)->first() !== null) {
            // The generated name is already used in the storage, call again `persist`
            // to take advantage of the name randomization.
            return ImageController::persist($name, $img, $depth-1);
        }

        // TODO: Create Image model obj
        

        Storage::disk('local')->put(ImageController::IMG_LOCAL_STORAGE_PATH.'/'.$filename, $img);
        // Return the id of the stored object.
        return Response($filename_raw);
    }
}
