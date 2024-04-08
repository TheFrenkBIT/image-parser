<?php

namespace App\Services;

use App\DTOs\ImageParseDTO;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImageParseService
{
    public function parseImage(ImageParseDTO $dto): string
    {
        $path = $dto->image->path();

        return (new TesseractOCR($path))->run();
    }
}