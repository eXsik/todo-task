<?php

use App\Console\Commands\SendTaskExpireSoonNotifications;
use Illuminate\Foundation\Inspiring;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Artisan::command('tasks:send-expiration-soon-emails', function () {
    $this->call(SendTaskExpireSoonNotifications::class);
})->dailyAt('10:00');