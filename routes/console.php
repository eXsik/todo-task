<?php

use App\Console\Commands\SendTaskExpireSoonNotifications;
use Illuminate\Support\Facades\Artisan;

Artisan::command('tasks:send-expiration-soon-emails', function () {
    $this->call(SendTaskExpireSoonNotifications::class);
})->dailyAt('10:00');