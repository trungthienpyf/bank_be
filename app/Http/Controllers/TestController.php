<?php

namespace App\Http\Controllers;



use App\Helpers\NexmoService;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use App\Traits\RefeshTokenTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Nexmo\Laravel\Facade\Nexmo;


class TestController extends Controller
{
    use RefeshTokenTrait;

    public function test(Request $request)
    {

    //  return   $this->loginUser('trungthienz123212', 'trungthienz123212');
    //  return $this->registerUser('thiendepssa2triaissai','thiendeptr2aihahahah','emaiasl@gmail.com','0223456789','0923423121','Trung Thien');
       // Cache::put('azzz','abvc',10);
      //  Cache::put('token','abvc',1000);
       // Cache::put('ab','abvc',1000);
//       $cache= Cache::remember('test', 10, function() {
//            return '123123';
//        });

        return $this->refreshToken();

    }


}
