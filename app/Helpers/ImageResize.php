<?php

namespace App\Helpers;

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 12/7/15
 * Time: 5:19 PM
 */
class ImageResize
{
    /*
     * $newWidth :: image size in width
     * $targetFile :: taget file and location
     * $originalFile  :: original file
     */
    public static function resize($newWidth, $targetFile, $originalFile) {

        $info = getimagesize($originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                return false;
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        #$image_save_func($tmp, "$targetFile.$new_image_ext"); // using extension as well as case
        $image_save_func($tmp, "$targetFile");

        return true;
    }

    public static function image_upload($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {
            $img_name = $image; //($_FILES['image']['name']);
            $random_number = rand(111, 999);
            $thumb_name = 'thumb_50x50_'.$random_number.'_'.$img_name;
            $newWidth = 200;
            $targetFile = $destinationPath.$thumb_name;
            $originalFile = $image;
            $resizedImages = ImageResize::resize($newWidth, $targetFile,$originalFile);
            $thumb_image_destination = $destinationPath;
            $thumb_image_name = $thumb_name;

            $rules = array('image' => 'required|mimes:'.$file_type_required);
            $validator = Validator::make(array('image' => $image), $rules);
            if ($validator->passes()) {
                // Files destination

                // Create folders if they don't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image_original_name = $image->getClientOriginalName();
                $image_name = rand(11111, 99999) . $image_original_name;
                $upload_success = $image->move($destinationPath, $image_name);
                $file=array($destinationPath . $image_name, $thumb_image_destination.$thumb_image_name);
                if ($upload_success) {
                    return $file_name = $file;
                }
                else{
                    return $file_name = '';
                }
            }
            else{
                return $file_name = '';
            }
        }
    }


}