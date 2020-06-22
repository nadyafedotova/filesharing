<?php

namespace App\Helpers\Image;

use Intervention\Image\ImageManagerStatic;

class Image
{
    /**
     * @var ImageResize
     */
    protected $imageResize;

    /**
     * @var ImageSave
     */
    protected $imageSave;

    /**
     * Create a new instance of Image.
     *
     * @param ImageResize $imageResize
     * @param ImageSave $imageSave
     */
    public function __construct(
        ImageResize $imageResize,
        ImageSave $imageSave
    )
    {
        $this->imageResize = $imageResize;
        $this->imageSave = $imageSave;
    }

    /**
     * Create path to image.
     *
     * @param string $pathToImage
     */
    public function create(string $pathToImage)
    {
        $resize = ImageManagerStatic::make($pathToImage);
        $pathName = $this->createName($pathToImage);

        $this->imageResize->resize($resize);

        $pathArray = explode("/", storage_path("app/public/images/$pathName"));
        $saveName = array_pop($pathArray);
        $savePath = implode("/", $pathArray);

        $this->imageSave->save($resize, $savePath, $saveName);
    }

    /**
     * Create a name based on $pathToImage.
     *
     * @param $pathToImage
     * @return string
     */
    protected function createName($pathToImage): string
    {
        $pathArray = explode("/", $pathToImage);
        $explodedPath = array_values(array_slice($pathArray, -3));
        $pathName = implode("/", $explodedPath);

        return $pathName;
    }
}
