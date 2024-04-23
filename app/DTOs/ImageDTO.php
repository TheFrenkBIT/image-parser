<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class ImageDTO extends DataTransferObject
{
    public ?UploadedFile $image = null;
}