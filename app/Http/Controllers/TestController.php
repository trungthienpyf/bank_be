<?php

namespace App\Http\Controllers;



use App\Helpers\NexmoService;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use App\Traits\RefeshTokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Nexmo\Laravel\Facade\Nexmo;


class TestController extends Controller
{
    use RefeshTokenTrait;

    public function test(Request $request)
    {


     // return $this->registerUser('thiendepssa2triaissai','thiendeptr2aihahahah','emaiasl@gmail.com','0223456789','0923423121','Trung Thien');
    return $request->all();
        return  $this->getCode($request->id);

    }


}
