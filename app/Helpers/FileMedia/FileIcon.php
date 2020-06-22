<?php

namespace App\Helpers\FileMedia;

class FileIcon
{
    /**
     * @var array
     */
    protected $supportedFileExtensions;

    /**
     * Create a new FileIcon instance.
     *
     */
    public function __construct()
    {
        $this->supportedFileExtensions = json_decode(file_get_contents(base_path("node_modules/file-icon-vectors/dist/icons/vivid/catalog.json")));
    }

    /**
     * Is there an icon for provided file extension.
     *
     * @param string $fileExtension
     * @return bool
     */
    public function hasIcon(string $fileExtension): bool
    {
        return in_array($fileExtension,$this->supportedFileExtensions) ? true : false;
    }
}
