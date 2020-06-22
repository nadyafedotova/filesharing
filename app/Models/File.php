<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that should cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "meta_data" => "array"
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "original_name", "storage_name", "extension", "meta_data", "has_related_icon"
    ];
}
