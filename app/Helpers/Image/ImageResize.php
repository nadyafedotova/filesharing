<?php

namespace App\Helpers\Image;

use Intervention\Image\Image;

class ImageResize
{
    /**
     * @var int
     */
    protected $maxWidth = 300;

    /**
     * @var int
     */
    protected $maxHeight = 300;

    /**
     * Resize comparing the actual dimensions with $maxWidth and $maxHeight.
     *
     * @param $resize
     * @return mixed
     */
    public function resize(Image $resize)
    {
        if ($resize->width() <= $this->maxWidth && $resize->height() <= $this->maxHeight) {
            return $resize;
        } elseif ($resize->width() > $resize->height()) {
            $resize->resize($this->maxWidth, null, function($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $resize->resize(null, $this->maxHeight, function($constraint) {
                $constraint->aspectRatio();
            });
        }
        return $resize;
    }
}
