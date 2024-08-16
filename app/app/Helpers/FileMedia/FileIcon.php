<?php

namespace App\Helpers\FileMedia;

class FileIcon
{
    public function __construct(
        protected array $supportedFileExtensions
    ) {
        $this->supportedFileExtensions = json_decode(
            file_get_contents(
                base_path(
                    '/node_modules/file-icon-vectors/dist/icons/vivid/catalog.json')
            )
        );
    }

    final public function hasIcon(string $fileExtension): bool
    {
        return in_array($fileExtension, $this->supportedFileExtensions);
    }
}
