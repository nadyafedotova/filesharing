<?php

namespace App\Http\Controllers;

use App\Models\File;
use JetBrains\PhpStorm\NoReturn;

class DownloadsController extends Controller
{
    #[NoReturn]
    final public function index(int $fileId): void
    {
        $file = File::findOrFail($fileId);
        $pathToFile = storage_path("app/files/{$file->storage_name}");
        $size = filesize($pathToFile);
        $contentType = $file->meta_data['mime_type'] ?? 'application/octet-stream';

        header('Content-Description: File Transfer');
        header("Content-Type: $contentType");
        header("Content-Disposition: attachment; filename=\"{$file->original_name}\"");
        header("Content-Length: $size");

        readfile($pathToFile);

        exit;
    }
}
