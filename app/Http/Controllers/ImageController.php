<?php

namespace App\Http\Controllers;

use Auth;
use Config;
use Response;
use Javascript;
use App\Http\Requests\ImageRequest;
use App\Repositories\ImageInterface;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * @var [type]
     */
    protected $imageInterface;

    /**
     * @param ImageInterface $imageInterface
     */
    public function __construct(ImageInterface $imageInterface)
    {
        $this->imageInterface = $imageInterface;
    }
    public function image()
    {

        // Permet d'appeler le fichier config.custom depuis un fichier js
        \JavaScript::put([
            'projet_url' => Config::get('custom.projet_url'),
        ]);

        $user = Auth::user();
        // $image = $this->imageInterface->showImage($user->id);

        return view('image', compact('user'));
    }

    public function create_image(Request $request)
    {
        $user = Auth::user();

        if($request->hasFile('image')){

            $image = $this->imageInterface->store($request, $user->id);

        }

        return redirect()->route('image');

    }

    // public function toto($user_id, $image)
    // {
    //     $path = Config::get('custom.image_path') .'\user_' . $user_id . '\\' . $image;
    //     if (file_exists($path)) {
    //         return Response::file($path);
    //     }
    // }

    public function upload_image(ImageRequest $request)
    {

        $user = Auth::user();


        $image = $this->imageInterface->storeBase64Image($request, $user->id);

        return response()->json([
            'cv' => $request->image,
        ]);
    }


    public function imageCropper()
    {

        // Permet d'appeler le fichier config.custom depuis un fichier js
        \JavaScript::put([
            'projet_url' => Config::get('custom.projet_url'),
        ]);

        $user = Auth::user();


      return view('imageCropper', compact('user'));
    }


    public function upload_image_crop(Request $request)
    {

        $user = Auth::user();

        $image = $this->imageInterface->storeBase64Image($request, $user->id);

        return response()->json([
            'cv' =>'kkkkkkkkkkkkkkkk',
        ]);

    }

}
