<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('binary:calculate')
    ->dailyAt('23:55');
Schedule::command('mlm:update-ranks')
    ->when(fn() => config('mlm.ranks.check_interval') === 'daily')
    ->daily()
    ->withoutOverlapping();

Schedule::command('mlm:update-ranks')
    ->when(fn() => config('mlm.ranks.check_interval') === 'weekly')
    ->weekly()
    ->withoutOverlapping();

Schedule::command('mlm:update-ranks')
    ->when(fn() => config('mlm.ranks.check_interval') === 'monthly')
    ->monthly()
    ->withoutOverlapping();