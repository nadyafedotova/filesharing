<?php

namespace App\Services;

use App\Helpers\FileMedia\FileIcon;
use App\Helpers\FileMedia\FileMedia;
use App\Helpers\Image\Image;
use App\Models\File;

class FileService
{
    /**
     * @var FileMedia
     */
    protected $fileMedia;

    /**
     * @var FileIcon
     */
    protected $fileIcon;

    /**
     * @var Image
     */
    protected $image;

    /**
     * Create a new FileService instance.
     *
     * @param FileMedia $fileMedia
     * @param FileIcon $fileIcon
     * @param Image $image
     */
    public function __construct(
        FileMedia $fileMedia,
        FileIcon $fileIcon,
        Image $image
    )
    {
        $this->getId3 = new \getID3();
        $this->fileMedia = $fileMedia;
        $this->fileIcon = $fileIcon;
        $this->image = $image;
    }

    /**
     * Store an uploaded file and save it to the database.
     *
     * @param $file
     * @return string  Path to uploaded file
     */
    public function handleUploadedFile($file): string
    {
        $currentYearMonth = date("Y/m");
        $fileExtension = $file->getClientOriginalExtension();
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));
        $fileMetaData = $this->fileMedia->bundleFileMetaData(storage_path("app/".$pathToFile));
        $hasRelatedIcon = $this->fileIcon->hasIcon($fileExtension) ? 1 : 0;


        if (array_key_exists("mime_type",$fileMetaData)
            && explode("/",$fileMetaData["mime_type"])[0] === "image") {
            $this->image->create(storage_path("app/$pathToFile"));
        }

        File::create([
            "original_name" => $file->getClientOriginalName(),
            "storage_name" => str_replace("files/", "", $pathToFile),
            "extension" => $fileExtension,
            "meta_data" => $fileMetaData,
            "has_related_icon" => $hasRelatedIcon,
        ]);

        return $pathToFile;
    }

    /**
     * Create a name for the file.
     *
     * @param $file
     * @return string
     */
    protected function makeFileName($file): string
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}
