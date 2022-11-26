<?php


namespace App\Traits;

use App\Helpers\NexmoService;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Spatie\Crypto\Rsa\PublicKey;
use function PHPUnit\Framework\throwException;


trait RefeshTokenTrait

{

    public $tokenAccess = 'eyJraWQiOiJXcDRGMndiQVpMa1d2WWgyNDhnYjNtUHBLRzZTdDRNcG85Tmc3U2diZ2E0PSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJmMjY1N2MxNy04ZTdlLTQ3YjItYTk4OS1jZDNlMjY0YWY4ZjgiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLmFwLXNvdXRoZWFzdC0xLmFtYXpvbmF3cy5jb21cL2FwLXNvdXRoZWFzdC0xX1FiMVE4VFBzVSIsImNvZ25pdG86dXNlcm5hbWUiOiJmMjY1N2MxNy04ZTdlLTQ3YjItYTk4OS1jZDNlMjY0YWY4ZjgiLCJvcmlnaW5fanRpIjoiOGM5NWFkYzgtMWU0ZS00ODYxLWFkODUtY2YyOGNkYWIwYTRhIiwiYXVkIjoic2lrY25laTR0MmgzbnRrcWo1ZDQ5bHR2ciIsImV2ZW50X2lkIjoiNzJjMTY3NGEtNTUxOC00N2M0LTgxZDktNDQxNjUyNTYwMmJkIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE2NjkxMjk5MzQsIm5hbWUiOiJUcnVuZyBUaGnhu4duIiwiZXhwIjoxNjY5NTMyMjU2LCJpYXQiOjE2Njk0NDU4NTYsImp0aSI6IjdlNjNlNDQzLTVkOTYtNGRjMC04MDRmLTExMTJjYzlkNDk0NCIsImVtYWlsIjoiMjY5LnRkZEBnbWFpbC5jb20ifQ.b07vNtsa_tzMqJUCDE8Hpx6l0uDgDVqIVefhdEKGWCKfdOZAxkbUQSMtOW7f62OEA6mZKdfUeFfKHYEo_Q5P0ZqkW3Jzn9QAqnWLavBdANMDh7vuvwm7hpOMF0UIURbPJpxe3Be1lpJZdY4DB8WyGGPSkHa7H8iY6YgJvy4q_PGgK3qaG0FdKzXCQT2vdegYWdYPzxO2xHsPcWZM32Gzfe5j8f0qlJGTQcGhgBNmut8-FkBq_-PpX3I390tf_GTgQADcR6NPh88S0sksze-QqVD9BtEQeJTmAVSBFyJliu7yimSpAiRHsSkyl1jQLz46P1O9yTUF0bnDqDF6505JcA';

    public function refestToken()
    {

        Http::asForm()->post('https://hdbank-hackathon.auth.ap-southeast-1.amazoncognito.com/oauth2/token', [
            'client_id ' => 'sikcnei4t2h3ntkqj5d49ltvr',
            'grant_type  ' => 'refresh_token',
            'refresh_token ' => 'eyJjdHkiOiJKV1QiLCJlbmMiOiJBMjU2R0NNIiwiYWxnIjoiUlNBLU9BRVAifQ.XbWKI-ObhFD9Puj9plhfgjfXIgS9OKpaKniuu0UbskrxBypygWrwsO56ZKVvEY_PC7i4MdacS8SlXFFNnWvVXSbdjwnSAdx_AVUwgYbljpeEiMPiqBk5UGGUE96FXNY_dm_OkS0LDgFfuOa6usym-zKL1AC6EDupoN4QaWCQK2CLhJKnkc7fFfAz2tK2HPZLXyciJA5rlzndUkMZA6lOKQxOBXSWE6ytzFiRKGWmMMtnozK2NtqGknmq0_rAv2aa83RUKzJod3dyxNLt8Uh64YF5w0wwamxrPGd1U9rZRrhlyQkJJEM38AF-OjWZE3Yktpx9Z1sZagnmEBbjy8VX8g.t7axQ27zS0pAj2YG.iPp4JG0agvkajvHvXPsgZ6D2YD1L1LrFjMzYxCP45Nfzgqn7ybcZ_l8jQyQwFkupAAZTD4GO-K3fUhqDrvbrEzd1NGizQ4yYc4USL8QqOq1u6bzMjxXAhkO_Hj4wsnZbtlStMueQq8UsBAcxhIvV6t8Docvk2FS4wtpdA7K0heP8nKKw1HUMh_5g6NO5Bfpgf6XEgHcy1XtzYdKSd9d0XyUbWEKZMF09x9a4zqRuMfshILZqOvVqsf7IxHDi4r7NhcMYfuRTHWw1PGwTjP5tskYyRJv3Y_xzh5SZVNkyBzPvKdoMNPj7EMRDPUJWi5_l8iDHf21UzW-KqjF775bimS3YL--dUWNyxdiDoevOOppA3w8JDZltBQlNgu49Ko-pjtuOPwHCTS1oJ08fjxzs_3O-5FsRX1m5IqRMfyItrjShW1iW1-DM9HHXUN8_i4zJdCSr7jcDYBo1OCV7WhvAvd-xnvtztN1ZTYTc5TJrDW4VtWtYWb-580tagFrgNF0WObmAwk211uusCiVt1l4SPAVhVaXScYmAF58H0RFC36YT2zISwpxvr9OzCsoSR0WV95bPKIu1TpNd1mTJjCj2UwT3o_nxw4pnbZSecctWFmiMZJhtny--alKQ8_AKu8_424xjPVVVHklCb5pmzBKRNOW8KnuN8t4AyI3NIipRWESRvghL8VbpUTqID_9hwxsut3X_0F7givv5YeOG_UkgyRDCuL5sG0ZpSMi7-xjfZ8UjQaepLBtThT-__lEPjvhsKN1WCCbG5ghc-7HqyUYFojG3pxf5O3FIuj3gdjXMxbIyrSLNVYC0uGcygFt0RuR9arqeQB_3Gk-WtUrZt1qRsJIruckrPLNT0G3MbHbJtPrPxeQ-pmHQafgdEzkBaXLMN3tFkgAzum21mrvKxFNb-p4Vs1SYZUtbcBbEY2C3UvMElQAGkMvgj5JdvxApjcollKU9QpR-6DrnF7IuvIzKJcSTKHsmvLfRsdeFPM26olgq1ixjCP3kYUKEaPJCxMQtlHZ_b_XAC2qjw2TkLPpiBen3wlg41BB6PmXmIV94IxsfUyQaYpvafRqQ9T_IrtUxfoRSPjANJWBteP1Ed6F_QzzgPmXno8t9DyngAkHFufniY1FCpjGB8qGA2dTmI64GknqVf1I0Q_AYj21vbobWmIH73MT9tBOpWHi9KWPsaZTFQn6SFtqvKVxA_huKnmVhwPJI7HT0bDbz0nmPJY0hXZ1XWoClFBBzhLBOM_Y9omKe-l34ctSm-bOcTrH72fGkfcwiXnHVkfXTZmkkbAje6YEAcujP15I3qNr6DtdcrZTxm451EvRNlyLQ0UE_83eDeb66RVGVXuoB.QcmPOSTo-ljPwcMa-Q33BA',
        ]);
    }

    public function registerUser($username, $password, $phone, $identityNumber, $fullName)
    {
        $public = $this->getPublicKey();

        $data = "{\"username\":\"{$username}\",\"password\":\"{$password}\"}";
        //  $public = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCDY1DzbqoavP8UVPYARHpy+zPlaFiBdf3imr5m4RdbHCwMueevk+NoWV2dqL/LBnk8oWMqWkgMDnTleXe/jvj6zQEuuCoBVDiZq4k0JXbHdTmXg0/fH7d9YD0BsSkpSJH8A9RBSnjvIzKLNHXKTUyxG1QIIKbU2lhVAB/jK2UtdwIDAQAB';

        $final = "-----BEGIN PUBLIC KEY-----\r\n" . wordwrap($public, 64, "\n", true) . "\r\n-----END PUBLIC KEY-----";
        openssl_public_encrypt($data, $encrypted, $final, OPENSSL_PKCS1_PADDING);

        $encrypted = base64_encode($encrypted);

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
            'access-token' => $this->tokenAccess,
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
        return Http::withHeaders([
            'access-token' => $this->tokenAccess,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->get('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/get_key')['data']['key'];
    }

    public function loginUser($username, $password)
    {

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
            'access-token' => $this->tokenAccess,
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
            'access-token' => $this->tokenAccess,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/transfer', $data);

        if (!empty($this->catchErrors($json, $data)['errors'])) {
            return $this->catchErrors($json, $data)['errors'];
        }

        Payment::create([
            'amount' => $amount,
            'description' => $desc,
            'toAcc' => $toAc,
            'fromAc' => $fromAc,
        ]);
        $user = User::where('id', $id)->first();
        $sum=   $user->money - $amount;
        $user->update(['money' => $sum]);
        return $amount;
    }


    public function getMoney($accountNo)
    {

        $data = [
            "data" => [
                "acctNo" => $accountNo,

            ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]
        ];
        return Http::withHeaders([
            'access-token' => $this->tokenAccess,
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/balance', $data);
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
