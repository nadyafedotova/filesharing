<?php

namespace App\Services;

use AllowDynamicProperties;
use App\Helpers\FileMedia\FileIcon;
use App\Helpers\FileMedia\FileMedia;
use App\Helpers\Image\Image;
use App\Models\File;
use getID3;

#[AllowDynamicProperties]
class FileService
{
    public function __construct(
        protected FileMedia $fileMedia,
        protected FileIcon $fileIcon,
        protected Image $image,
        protected getID3 $getId3 = new getID3(),
    )
    {
        $this->getId3 = new getID3();
    }

    final public function handleUploadedFile(mixed $file): string
    {
        $currentYearMonth = date("Y/m");
        $fileExtension = $file->getClientOriginalExtension();
        $pathToFile = $file->storeAs("files/{$currentYearMonth}", $this->makeFileName($file));
        $fileMetaData = $this->fileMedia->bundleFileMetaData(storage_path("app/".$pathToFile));
        $hasRelatedIcon = $this->fileIcon->hasIcon($fileExtension) ? 1 : 0;

        if (array_key_exists("mime_type", $fileMetaData)
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

    final protected function makeFileName(mixed $file): string
    {
        return time() . "." . $file->getClientOriginalExtension();
    }
}
