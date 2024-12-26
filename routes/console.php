<?php

use App\CatalogContext\ScraperModule\Infrastructure\Cli\SaveAllProductsFromUrl;
use App\CatalogContext\ScraperModule\Infrastructure\Cli\ShowAllProductsFromUrl;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('product:save-all-from-url {url}', function ($url) {
    $command = app(SaveAllProductsFromUrl::class);
    $command->handle($url);
})->purpose('Save all products from a given url');

Artisan::command('product:show-all-from-url {url}', function ($url) {
    $command = app(ShowAllProductsFromUrl::class);
    $command->handle($url);
})->purpose('Show all products from a given url');
