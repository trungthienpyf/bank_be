<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Traits\RefeshTokenTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;


class UserController extends Controller
{

    use RefeshTokenTrait;
    public function login(Request $request)
    {

        return $this->loginUser($request->username, $request->password);
    }

    public function getCodeOTP(Request $request)

    {

        return  $this->getCode($request->id);
    }
    public function checkOTP(Request $request)

    {

        return  $this->checkCode($request->id,$request->token,$request->amount,$request->desc,$request->fromAc,$request->toAc);
    }
    public function register(StoreUserRequest $request)
    {


       return $this->registerUser($request->username, $request->password,$request->phone,$request->identityNumber,$request->fullName);
    }
}
