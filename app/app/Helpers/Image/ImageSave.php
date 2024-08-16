<?php

namespace App\Helpers\Image;

use Intervention\Image\Image;

class ImageSave
{
    /**
     * Save an image preview under $saveName to $savePath.
     * Creates necessary folders if $savePath does not exist.
     *
     * @param $path
     * @param string $savePath
     * @param string $saveName
     * @return string  Path to the saved path
     */
    public function save(Image $path, string $savePath, string $saveName): string
    {
        if (!file_exists($savePath)) {
            mkdir($savePath, 0777, true);
        }
        $fullPath = $savePath."/".$saveName;
        $path->save($fullPath);

        return $fullPath;
    }
}
