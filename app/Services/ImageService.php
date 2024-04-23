<?php

namespace App\Services;

use App\DTOs\ImageDTO;
use App\Factories\QueueFactory;
use App\Helpers\Normalizer;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImageService
{
    public function saveImage(ImageDTO $dto)
    {
        $path = Storage::path(
            $dto->image->store('images')
        );
        $result = Image::create([
            'image_path' => $path
        ]);
        app(QueueFactory::class)->publishMessage(Normalizer::imageDataForQueue($result));
        app(QueueFactory::class)->closeConnection();

    }
    public function consumeImage(): void
    {
        app(QueueFactory::class)->consumeMessage([$this, 'parseImage']);
    }

    public function parseImage($message): void
    {
        if (!json_validate($message->body)) {
            exit;
        }
        $data = json_decode($message->body, true);
        $text = (new TesseractOCR($data['path']))->run();
        Image::find($data['id'])
            ->update([
                'parsed_result' => $text
            ]);
    }
}