<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {

    User::where("tfa_enable", true)->each(function ($user) {
        $user->tfa_code = random_int(1000, 9999);
        $user->save();
    });
})->everyFiveSeconds();


Artisan::command("tfa" , function(){
    User::where("tfa_enable", true)->each(function ($user) {
        $user->tfa_code = random_int(1000, 9999);
        $user->save();
    });
});