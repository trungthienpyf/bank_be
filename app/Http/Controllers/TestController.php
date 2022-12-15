<?php

namespace App\Http\Controllers;



use App\Helpers\NexmoService;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use App\Traits\RefeshTokenTrait;
use App\Traits\PostCommentTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Nexmo\Laravel\Facade\Nexmo;


class TestController extends Controller
{
    use RefeshTokenTrait;
    use PostCommentTrait;

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
        $otp = mt_rand(10000, 99999);

        $token = $otp . '@' . now()->addMinutes(3);
        $user = User::where('id', '2')->first();
        $user->update(['token' => $token]);
         //NexmoService::send($user->phone ,$otp);

        return 1;


    }


}
