<?php

namespace App\Repositories;

use Config;
use DateTime;
use Image;
use File;
use DB;
use App\Models\User;

use App\Models\Image as Picture;

class ImageRepository implements ImageInterface
{
	protected $picture;

	public function __construct(Picture $picture)
	{
		$this->picture = $picture;
	}

	public function getAll()
	{
		return $this->picture->all();

	}

    public function store($request, $id)
	{

        $image = $request->image;

        $file_path = Config::get('custom.image_path') . 'user_' . $id . DIRECTORY_SEPARATOR;

        //Je recherche l'extension de l'image
        $image_extension = $image->getClientOriginalExtension();

        // On renomme l'image et on le concatène avec un timestamp et ajoute l'extension
        $date = new DateTime();

        $filename = 'image_user_' . $id . '_' . $date->getTimestamp() . '.' . $image_extension;

        $img = Image::make($image->getRealPath())->orientate();


        if (!file_exists($file_path)) {
            // path does not exist
            File::makeDirectory($file_path, $mode = 0777, true, true);
        }

        $img->save($file_path . $filename);

        DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'picture' => $filename
                    ]);

        return true;
	}

    // public function store($request, $id)
	// {

    //     $image = $request->image;

    //     // $file_path = Config::get('custom.image_path') . 'user_' . $id . DIRECTORY_SEPARATOR;
    //     $file_path = 'resources/user_' . $id . DIRECTORY_SEPARATOR;

    //     //Je recherche l'extension de l'image
    //     $image_extension = $image->getClientOriginalExtension();

    //     // On renomme l'image et on le concatène avec un timestamp et ajoute l'extension
    //     $date = new DateTime();

    //     $filename = 'image_user_' . $id . '_' . $date->getTimestamp() . '.' . $image_extension;

    //     $img = Image::make($image->getRealPath())->orientate();


    //     if (!file_exists($file_path)) {
    //         // path does not exist
    //         File::makeDirectory($file_path, $mode = 0777, true, true);
    //     }

    //     $img->save($file_path . $filename);

    //     DB::table('users')
    //                 ->where('id', $id)
    //                 ->update([
    //                     'picture' => $filename
    //                 ]);

    //     return true;
	// }

    /**
     * @param mixed $request
     * @param mixed $id
     *
     * @return [type]
     */
    public function storeBase64Image($request, $id)
	{

        $image = $request->image;

        // $file_path = Config::get('custom.image_path') . 'user_' . $id . DIRECTORY_SEPARATOR;
        $file_path = 'resources/user_' . $id . DIRECTORY_SEPARATOR;

        //Je recherche l'extension de l'image
        $image_extension = explode('/', mime_content_type($image))[1];

        // On renomme l'image et on le concatène avec un timestamp et ajoute l'extension
        $date = new DateTime();

        $filename = 'image_user_' . $id . '_' . $date->getTimestamp() . '.' . $image_extension;

        //On extrait l'image à décoder
        $data = explode(',', $image);

		$picture = \base64_decode( $data[1], true);

        $img = Image::make($picture)->orientate();


        if (!file_exists($file_path)) {
            // path does not exist
            File::makeDirectory($file_path, $mode = 0777, true, true);
        }

        $img->save($file_path . $filename);

        DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'picture' => $filename
                    ]);

        return true;
	}




}
