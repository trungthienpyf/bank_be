<?php


namespace App\Traits;

use App\Helpers\NexmoService;
use App\Models\Payment;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Spatie\Crypto\Rsa\PublicKey;



trait RefeshTokenTrait

{


    public function refreshToken()
    {
        $string='client_id=sikcnei4t2h3ntkqj5d49ltvr&grant_type=refresh_token&refresh_token=eyJjdHkiOiJKV1QiLCJlbmMiOiJBMjU2R0NNIiwiYWxnIjoiUlNBLU9BRVAifQ.jvk-LNbQtUrf4Kra912NuJqW-43EdEbzDLEzJhQ4Hts5YV8mDw1TYK2Eqi68ZjdpjM9aVLkqUw4Cky8mO0pwueg1888CUCRq1SB3wkIz-IvkbHR21mfYG94hBJt1Pwo956H_YKZl7TmVfV_tYIPaDx5c6sStH95J7Bdy6toamXRWPjFaq3YvVuJyFoaogfUnvPaMZa0PEe8rzyHWyw5_sia9UlqgQqHkB_jszyvMfsK1ef6-vDChA-kTr6FVwjlmwTSanLzn0c2vvAw22VWt6kYD7aCibakT96SlBYM2qMNJ94b4OmXILX7_eJ2OnK71joIWXuB5Kw9cM7NZqKmvMA.u6KiZfI4Q8yftcJY.10Mn0qi4MHf5_YJ7wxUD5GqmYR1NLrFe4KZtmNw09bLExrtolHGbS5mZLt3Nb-20WH3AyhaQdL21eNt637DXmCgLyQvlNhbQ1OvgtuxyM_gY4SojM8D0vonLhv3IMXod5cvoJOlzwXMCheRpS9WjJxzbd20qjuHBjGXH-kSzF9PXnieSWUwil3HrJ9AGIcN2zQ_0fufIwoyMp31r-fDAv2g92DQQzqS-GoZ8xdpfa3QwKfEuhXLjOE5gs5XAOD57i_mlvbOUTJZNLX8K4v5WnFBywMOFshTNySmYtntsUM5_B3Baxg7Zr67AOfqx6qrih2nX5NZ2U-NhtEzq1_aFcfCCnM5Qhn4ev3uMeHPCOnjyvicTxWgidaH5MtciVDxFGXYTVXM0guSJnNS6xC9GNLy5zO1pS6AElJS4k4DrDrw59JexUbNMj7_CGRZ80GzhS3YOxTqvpnz9guXnq2SEcf_nB8WXJPdim7epTINzxzMmT_5l9wCqci8KHT0WQJpVTQaXBE8gMJY7WjAgfBiSZ0vD3iIm02h3p0uFuQNk0V-NyrQ9fgeixoSHk6z2v-wU_fXN8eYAAacRmcJZ439t8x66B6H7qCEDmjWSzkLMd-6WYupTHH-ZAsR-WzGFmkv5tKM7rr2t7ibwOIZFyLkXY5YiVE8VqamEuiMtG1KGRtm5iiaNRgDzxhcTi6fc_ACiRKZ6t8vpqo7dsDQUBFsXuWgsC9kGHX9cFnQnnTuCmVo_cNC8F7LIndA1d3RNsrXI8uURjo2wtoHCtFjUtR5NheMAbQUVo8Tg33HW368FCRCODzfmz_37ZNPEGyFYsMwaqITS5nF1grfuMsWvweU1lwgvMQf32M1rp8GZNEp-DzPIf7kkpGKnF38D94rcfueZGuFVL6vHsIG5UJp6nXefoyVe_wx1PeQXbWRorCVOVutpJSXUpZ3EyytW3GdIh3kP2rlhsxkAr9hxf8i1XXupySHFsCIgJq8h-ivtUsO4IJfMYJOO8sS8xLmkBbkdGzxKw0gNtlsQl_xZCw6OGwyIS9DY5mdSOSmOi9YOLQvCnrvIFlSS2-839ua91QuvIvNFBgvc-I_Xze9bHM5e1wLor2d93a0gqutCiOw-mCM4bjIG9jBr0SjkvHJVS_bkv6saF17MSwK08PXdMx1nskCRr-SmO2jA9doc4Kt3kIesPC1psNd30-DKzlMmmGMDVYBIIF18pGz1CxQqDi7LR3rPD1uFkB3FuKjnj_7Fv3gCxSs7pc96-Oy6fKDhqLI7HAGon47o4mXYPEoLKPTtdK0SjIz37otcDiq9lEp-4XJ4qzHNzrbDSQ63m0fr5_uxuJDZCq3k8VFbNA.zkuaFR6fwP0KkRVt5ILsEQ';
      $newToken=   Http::asForm()->withBody(  $string,'' )->post('https://hdbank-hackathon.auth.ap-southeast-1.amazoncognito.com/oauth2/token')['id_token'];

      Cache::put('access_token', $newToken, 86400);
      return  Cache::get('access_token');
    }



    public function registerUser($username, $password, $phone, $identityNumber, $fullName)
    {
        $public = $this->getPublicKey();

        $data = "{\"username\":\"{$username}\",\"password\":\"{$password}\"}";
        //  $public = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCDY1DzbqoavP8UVPYARHpy+zPlaFiBdf3imr5m4RdbHCwMueevk+NoWV2dqL/LBnk8oWMqWkgMDnTleXe/jvj6zQEuuCoBVDiZq4k0JXbHdTmXg0/fH7d9YD0BsSkpSJH8A9RBSnjvIzKLNHXKTUyxG1QIIKbU2lhVAB/jK2UtdwIDAQAB';

        $final = "-----BEGIN PUBLIC KEY-----\r\n" . wordwrap($public, 64, "\n", true) . "\r\n-----END PUBLIC KEY-----";
        openssl_public_encrypt($data, $encrypted, $final, OPENSSL_PKCS1_PADDING);

        $encrypted = base64_encode($encrypted);
        $access_tk='';
        if (Cache::get('access_token')) {

            $access_tk = Cache::get('access_token');
        } else {
           $access_tk= $this->refreshToken();
        }

        $data = [
            "data" => [
                "credential" => $encrypted,
                "email" => 'bingchillingne@gmail.com',
                "fullName" => $fullName,
                "identityNumber" => $identityNumber,
                "key" => $public,
                "phone" => $phone,
            ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]
        ];

        $json = Http::withHeaders([
            'access-token' => $access_tk,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/register', $data);

        if (!empty($this->catchErrors($json, $data)['errors'])) {
            return ['errors' => $this->catchErrors($json, $data)['errors']];
        }
        User::create([
            'username' => $username,
            'password' => $password,
            'credential' => $encrypted,
            'identityNumber' => $identityNumber,
            'phone' => $phone,
            'fullName' => $fullName,

        ]);
        return "Đăng ký tài khoản thành công";
    }

    public function getPublicKey()
    {
        $access_tk='';
        if (Cache::get('access_token')) {

            $access_tk = Cache::get('access_token');
        } else {
            $access_tk= $this->refreshToken();
        }

        return Http::withHeaders([
            'access-token' => $access_tk,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->get('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/get_key')['data']['key'];
    }

    public function loginUser($username, $password)
    {

        $access_tk='';
        if (Cache::get('access_token')) {

            $access_tk = Cache::get('access_token');
        } else {
            $access_tk= $this->refreshToken();
        }

        $user = User::query()
            ->where('username', $username)
            ->where('password', $password)
            ->first();
        if (empty($user)) {
            return ['errors' => "Tài khoản và mật khẩu không chính xác"];
        }
        $public = $this->getPublicKey();

        $data = [
            "data" => [
                "credential" => $user->credential,
                "key" => $public,
            ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]
        ];


        $json = Http::withHeaders([
            'access-token' => $access_tk,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/login', $data);

        if (!empty($this->catchErrors($json, $data)['errors'])) {
            return $this->catchErrors($json, $data)['errors'];
        }

        $accNo = $json['data']['accountNo'];
        if (empty($user->accountNumber)) {

            $user->update(['accountNumber' => $accNo]);
        }
        if (empty($user->money)) {
            $money = $this->getMoney($accNo)['data']['amount'];
            $user->update(['money' => $money]);
        }

        return $user;
    }

    public function getCode($id)
    {

        $otp = mt_rand(10000, 99999);

        $token = $otp . '@' . now()->addMinutes(2);
        $user = User::where('id', $id)->first();
        $user->update(['token' => $token]);
        // NexmoService::send('0917516844' ,$otp);
        return '00';
    }

    public function checkCode($id, $code, $amount, $desc, $fromAc, $toAc)
    {
        if (empty($desc)) {
            $desc = 'Chuyển tiền';
        }
        $user = User::where('id', $id)->first();


        $pos = 4;
        $token = substr($user->token, 0, $pos + 1);
        $end = substr($user->token, $pos + 2);


        if ($token != $code) {
            return ['errors' => 'Mã OTP không chính xác'];
        } else if (strtotime($end) < strtotime(now())) {

            return ['errors' => 'Mã OTP đã hết hạn'];

        }


        return $this->sendMoney($amount, $desc, $fromAc, $toAc, $id);


    }

    public function sendMoney($amount, $desc, $fromAc, $toAc, $id)
    {
        $access_tk='';
        if (Cache::get('access_token')) {
            $access_tk = Cache::get('access_token');
        } else {
            $access_tk= $this->refreshToken();
        }

        $data = [
            "data" => [
                "amount" => $amount,
                "description" => $desc,
                "fromAcct" => $fromAc,
                "toAcct" => $toAc,

            ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]
        ];
        $json = Http::withHeaders([
            'access-token' => $access_tk,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/transfer', $data);

        if (!empty($this->catchErrors($json, $data)['errors'])) {
            return $this->catchErrors($json, $data)['errors'];
        }

        Payment::create([
            'amount' => $amount,
            'description' => $desc,
            'toAcc' => $toAc,
            'fromAcc' => $fromAc,
        ]);
        $userReceive = User::where('accountNumber', $toAc)->first();
        $userReceive->update(['money' => $userReceive->money + $amount]);
        $user = User::where('id', $id)->first();
        $sum = $user->money - $amount;
        $user->update(['money' => $sum]);
        return $amount;
    }

//    public function getHistory($accountNo)
//    {
//        $data = [
//            "data" => [
//                "acctNo" => $accountNo,
//                "fromDate" => '23012021',
//                "toDate" => '30012021',
//
//            ],
//            "request" => [
//                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
//                "requestTime" => "1667200102200"
//            ]
//        ];
//        return Http::withHeaders([
//            'access-token' => $this->tokenAccess,
//            'x-api-key' => 'hutech_hackathon@123456'
//        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/tranhis', $data);
//    }

    public function getHistoryPayment($accountNo)
    {

        $payments =
            Payment::query()
                ->whereHas('user', function ($query) use ($accountNo) {
                    $query->where('accountNumber', $accountNo);
                })
                ->latest()
                ->get();


        $paymentsTo =
            Payment::query()
                ->whereHas('userTo', function ($query) use ($accountNo) {
                    $query->where('accountNumber', $accountNo);
                })
                ->latest()
                ->get();
        $history = $payments->merge($paymentsTo);

        $sortCollect = collect($history)->sortByDesc('created_at')->values();
        $list = collect($sortCollect)->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        })->sortByDesc('created_at');
        return $list;
    }

    public function getMoney($accountNo)
    {
        $access_tk='';
        if (Cache::get('access_token')) {
            $access_tk = Cache::get('access_token');
        } else {
            $access_tk= $this->refreshToken();
        }

        $data = [
            "data" => [
                "acctNo" => $accountNo,

            ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]
        ];
        $json = Http::withHeaders([
            'access-token' => $access_tk,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/balance', $data);

        return $json;
    }

    public function catchErrors($json, $data)
    {
        try {
            if ($json['response']['responseCode'] == "00") {
                return $data;
            } else if ($json['response']['responseCode'] == "01") {
                throw new \Exception('Unauthorized');
            } else if ($json['response']['responseCode'] == "02") {
                throw new \Exception('Key expired or not match');
            } else if ($json['response']['responseCode'] == "03") {
                throw new \Exception('Format message invalid');
            } else if ($json['response']['responseCode'] == "04") {
                throw new \Exception('Not enough money');
            } else if ($json['response']['responseCode'] == "06") {
                throw new \Exception('Bank end of date');
            } else if ($json['response']['responseCode'] == "07") {
                throw new \Exception('BankAccount not found');
            } else if ($json['response']['responseCode'] == "08") {
                throw new \Exception('BankAccount not active');
            } else if ($json['response']['responseCode'] == "09") {
                throw new \Exception('BankAccount ccy invalid');
            } else if ($json['response']['responseCode'] == "10") {
                throw new \Exception('Fee not found');
            } else if ($json['response']['responseCode'] == "11") {
                throw new \Exception('User already exists');
            } else if ($json['response']['responseCode'] == "99") {
                throw new \Exception('System error');
            }
        } catch (\Throwable $th) {
            return ['errors' => $th->getMessage()];
        }

    }

}
