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
    public function register(StoreUserRequest $request)
    {


       return $this->registerUser($request->username, $request->password,$request->phone,$request->identityNumber,$request->fullName);
    }
}
