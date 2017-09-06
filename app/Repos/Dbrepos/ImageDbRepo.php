<?php namespace App\Repos\Dbrepos;

use App\Image;
use Intervention\Image\Facades\Image as ImageManager;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ImageDbRepo
 * @package App\Repos\Dbrepos
 */
class ImageDbRepo {

    /**
     * @param $width
     * @param $height
     * @param $imageFullName
     * @param $thumbName
     * @return mixed
     */
    public function resizeImage($width, $height, $imageFullName, $thumbName)
    {
        return ImageManager::make(public_path('images/uploads/'.$imageFullName))
                            ->resize($width, $height)
                            ->save(public_path('images/uploads/thumbs/'.$thumbName));
    }

    /**
     * @param $originalName
     * @param $imageFullName
     * @param $thumbName
     * @return bool
     */
    public function saveToDb($originalName, $imageFullName, $thumbName)
    {
        $imagemodal = new Image;

        $imagemodal->image_original_name        =       $originalName;
        $imagemodal->image_name                 =       $imageFullName;
        $imagemodal->thumb_name                 =       $thumbName;

        $result = $imagemodal->save();
        return $result;
    }

    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage($image, $imageFullName, $storage)
    {
        $filesystem = new Filesystem;
        return $storage->disk('local')->put($imageFullName,  $filesystem->get($image));
    }

}