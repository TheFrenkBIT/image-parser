<?php

namespace App\Console\Commands;

use App\Services\ImageParseService;
use Illuminate\Console\Command;

class ImageParse extends Command
{
    protected $signature = 'image:parse';

    public function handle()
    {
        app(ImageParseService::class)->parseImage();

        $this->info('The command was successful!');
    }
}