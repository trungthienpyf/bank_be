<?php
namespace App\Helpers;




use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class NexmoService
{
    public static function send($phoneNumber,$code)
    {

        //Huong dan chi tiet cach su dung API: http://esms.vn/blog/3-buoc-de-co-the-gui-tin-nhan-tu-website-ung-dung-cua-ban-bang-sms-api-cua-esmsvn
        //De lay Key cac ban dang nhap eSMS.vn v� vao quan Quan li API
        $APIKey="6E4963B7BB53B294969FDDF8C6B266";
        $SecretKey="57BDA0F954EB029D5B6473C4C3BD44";
        $YourPhone=$phoneNumber;
        $Content="Your verification code is ".$code;

        $SendContent=urlencode($Content);
        $data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Brandname=Baotrixemay&SmsType=2";
        //De dang ky brandname rieng vui long lien he hotline 0901.888.484 hoac nhan vien kinh Doanh cua ban
        $curl = curl_init($data);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);

        $obj = json_decode($result,true);
        if($obj['CodeResult']==100)
        {
            print "<br>";
            print "CodeResult:".$obj['CodeResult'];
            print "<br>";
            print "CountRegenerate:".$obj['CountRegenerate'];
            print "<br>";
            print "SMSID:".$obj['SMSID'];
            print "<br>";
        }
        else
        {
            print "ErrorMessage:".$obj['ErrorMessage'];
        }


    }


}

