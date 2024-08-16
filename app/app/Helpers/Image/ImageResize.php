<?php

namespace App\Helpers\Image;

use Intervention\Image\Image;

class ImageResize
{
    private const MAXWIDTH = 300;

    private const MAXHEIGTH = 300;

    final public function resize(Image $resize)
    {
        if ($resize->width() <= self::MAXWIDTH && $resize->height() <= self::MAXHEIGTH) {
            return $resize;
        } elseif ($resize->width() > $resize->height()) {
            $resize->resize(self::MAXWIDTH , null, function($constraint) {
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
