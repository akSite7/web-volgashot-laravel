<?php

use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;

Artisan::command('generate:sitemap', function () {
    $url = config('app.url'); // берёт из .env -> APP_URL

    $sitemap = Sitemap::create()
        ->add(Url::create("{$url}/")->setPriority(1.0))
        ->add(Url::create("{$url}/category/fraction")->setPriority(0.8))
        ->add(Url::create("{$url}/category/buckshot")->setPriority(0.8))
        ->add(Url::create("{$url}/cart")->setPriority(0.5))
        ->add(Url::create("{$url}/cart/order")->setPriority(0.5))
        ->add(Url::create("{$url}/thank-you")->setPriority(0.3))
        ->add(Url::create("{$url}/contact")->setPriority(0.6));

    $sitemap->writeToFile(public_path('sitemap.xml'));

    $this->info('✅ sitemap.xml создан!');
})->purpose('Generate sitemap.xml for the site');