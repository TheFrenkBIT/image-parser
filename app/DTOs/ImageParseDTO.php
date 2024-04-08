<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class ImageParseDTO extends DataTransferObject
{
    public ?UploadedFile $image = null;
}