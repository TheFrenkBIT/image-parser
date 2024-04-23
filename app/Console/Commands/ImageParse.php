<?php

namespace App\Console\Commands;

use App\Services\ImageService;
use Illuminate\Console\Command;

class ImageParse extends Command
{
    protected $signature = 'image:parse';

    public function handle()
    {
        app(ImageService::class)->consumeImage();

        $this->info('The command was successful!');
    }
}