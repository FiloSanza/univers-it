<?php

namespace App\Http\Controllers;

use App\Models\ReactionImage;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ReactionImageController extends Controller
{
    /**
     * Save a new Reaction Image.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate(ReactionImage::VALIDATION_RULES);

        $reaction_image = new ReactionImage();

        $reaction_image->name = $request->name;
        $reaction_image->image_id = ImageController::persist($request->image);

        $reaction_image->save();

        return Response('Success.', 200);
    }
}
