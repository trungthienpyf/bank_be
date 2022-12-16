<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
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

    public function authOTPRoom(Request $request)
    {

        return $this->authenticationCode($request->id, $request->code);

    }
    public function getAllUser()
    {
        return User::all()->map(function ($user) {
            return [
                'id'=>$user->id,
                'value' => $user->accountNumber,
                'label' => $user->fullName . ' - ' . $user->accountNumber,
//                'email' => $user->email,

            ];
        });
    }
    public function checkPhone(StoreRegisterRequest $request){
        return '00';
    }

    public function getCodeOTP(StorePaymentRequest $request)
    {

        return $this->getCode($request->id);
    }

    public function checkOTP(Request $request)

    {

        return $this->checkCode($request->id, $request->token, $request->amount, $request->desc, $request->fromAc, $request->toAc);
    }

    public function register(StoreUserRequest $request)
    {
        return $this->registerUser($request->username, $request->password, $request->phone, $request->identityNumber, $request->fullName);
    }

    public function getHistory(Request $request)
    {
        return $this->getHistoryPayment($request->accountNumber);
    }
}
