<?php

namespace App\Helpers\FileMedia;

class FileMedia
{
    /**
     * @var \getID3
     */
    protected $getId3;

    /**
     * @var MetaDataGrabber
     */
    protected $metaDataGrabber;

    /**
     * Create a new FileMedia.
     *
     * @param MetaDataGrabber $metaDataGrabber
     */
    public function __construct(MetaDataGrabber $metaDataGrabber)
    {
        $this->getId3 = new \getID3();
        $this->metaDataGrabber = $metaDataGrabber;
    }

    /**
     * Meta data for a file.
     * Getting the file info using library getId3
     *
     * @param string $pathToFile
     * @return array
     */
    public function bundleFileMetaData(string $pathToFile): array
    {
        $fileInfo = $this->getId3->analyze($pathToFile);

        $fileMetaData = [];

        if (array_key_exists("mime_type", $fileInfo)) {
            $mimeType = $fileInfo["mime_type"];
            $fileType = explode("/", $mimeType)[0];
            $fileMetaData = $this->metaDataGrabber->grabMetaData($fileType, $fileInfo);
            $fileMetaData["mime_type"] = $mimeType;
        }

        if (array_key_exists("filesize", $fileInfo)) {
            $fileMetaData["filesize"] = $fileInfo["filesize"];
        }
        return $fileMetaData;
    }
}
