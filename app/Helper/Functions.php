<?php

namespace App\Helper;

class Functions{
    public static function replaceName($string){
        $string = preg_replace("/Controller/", "", $string);

        return strtolower($string);
    }

    public static function getImage($folderUpload, $fileImage){
        $path = public_path() . "/picture/" . $folderUpload . "/" . $fileImage  ;
        if(isset($fileImage) && file_exists($path)){
            return asset("picture/" . $folderUpload . "/" . $fileImage);
        }else{
            return asset("picture/default-image.jpg");
        }
    }
}
