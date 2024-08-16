<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $casts = [
        'meta_data' => 'array'
    ];

    protected $fillable = [
        'original_name', 'storage_name', 'extension', 'meta_data', 'has_related_icon',
    ];
}
