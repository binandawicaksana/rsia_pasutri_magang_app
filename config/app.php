<?php
return [
 'name' => env('APP_NAME','Laravel'), 'env' => env('APP_ENV','production'), 'key' => env('APP_KEY'), 'cipher' => 'AES-256-CBC', 'debug' => (bool) env('APP_DEBUG',false), 'url' => env('APP_URL','http://localhost'), 'timezone' => env('APP_TIMEZONE','UTC'), 'locale' => env('APP_LOCALE','en'), 'faker_locale' => env('APP_FAKER_LOCALE','en_US'), 'maintenance' => ['driver'=>'file','store'=>'database'], 'providers' => Illuminate\Support\ServiceProvider::defaultProviders()->merge([App\Providers\AppServiceProvider::class])->toArray(),
];
