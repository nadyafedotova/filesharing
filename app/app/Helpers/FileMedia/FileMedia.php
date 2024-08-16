<?php

namespace App\Helpers\FileMedia;

use Exception;
use getID3;

readonly class FileMedia
{
    public function __construct(
        private MetaDataGrabber $metaDataGrabber,
        private getID3          $getId3
    ) {
    }

    final public function bundleFileMetaData(string $pathToFile): array
    {
        try {
            $fileInfo = $this->getId3->analyze($pathToFile);
        } catch (Exception) {
            return [];
        }

        $fileMetaData = [];

        if (isset($fileInfo['mime_type'])) {
            $fileType = explode("/", $fileInfo['mime_type'])[0];
            $fileMetaData = $this->metaDataGrabber->grabMetaData($fileType, $fileInfo);
            $fileMetaData['mime_type'] = $fileInfo['mime_type'];
        }

        if (isset($fileInfo['filesize'])) {
            $fileMetaData['filesize'] = $fileInfo['filesize'];
        }

        return $fileMetaData;
    }
}
