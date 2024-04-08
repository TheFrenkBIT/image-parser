<?php

namespace App\Http\Controllers;

use App\DTOs\ImageParseDTO;
use App\Http\Requests\ImageParseRequest;
use App\Services\ImageParseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ImageParseController extends Controller
{
    public function __construct(
        private readonly ImageParseService $imageParseService
    )
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function imageParse(ImageParseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $dto = new ImageParseDTO($data);

        $text = $this->imageParseService->parseImage($dto);

        return \response()->json([
            'text' => $text
        ]);
    }
}