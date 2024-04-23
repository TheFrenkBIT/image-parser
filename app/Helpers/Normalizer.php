<?php

namespace App\Helpers;

use App\Models\Image;

class Normalizer
{
    public static function imageDataForQueue(Image $image): string
    {
        return json_encode([
            'id' => $image->getAttribute('id'),
            'path' => $image->getAttribute('image_path')
        ]);
    }
}