<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Schedule::command('commission:transfer-to-main')
    ->dailyAt('23:55');

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
