<?php

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    
    $users=User::where('tfa_enable', 1)->get();
    foreach ($users as $user) {
        $code = random_int(1000, 9999);
        $user->tfa_code =  $code;
        $user->save();
    }
   
})->everyMinute();