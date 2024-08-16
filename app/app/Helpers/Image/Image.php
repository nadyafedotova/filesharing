<?php

namespace App\Helpers\Image;

use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

readonly class Image
{
    public function __construct(
        private ImageResize $imageResize,
        private ImageSave   $imageSave,
    )
    {
    }

    final public function create(string $pathToImage): void
    {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($pathToImage);
        $savePath = $this->generateSavePath($pathToImage);
        $this->imageResize->resize($image);
        $this->imageSave->save($image, $savePath['directory'], $savePath['filename']);
    }

    final protected function generateSavePath(string $pathToImage): array
    {
        $relativePath = implode("/", array_slice(explode("/", $pathToImage), -3));
        $fullPath = storage_path("app/public/images/$relativePath");

        return [
            'directory' => dirname($fullPath),
            'filename' => basename($fullPath),
        ];
    }
}
