<?php

namespace App\Http\Controllers;

use App\DTOs\ImageDTO;
use App\DTOs\ImageParseDTO;
use App\Http\Requests\ImageParseRequest;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ImageController
{
    public function __construct(
        private readonly ImageService $imageService
    )
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function saveImageInQueue(ImageParseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $dto = new ImageDTO($data);

        $this->imageService->saveImage($dto);

        return \response()->json(true);
    }
}