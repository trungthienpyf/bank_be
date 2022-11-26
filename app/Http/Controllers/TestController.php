<?php

namespace App\Http\Controllers;



use App\Traits\RefeshTokenTrait;
use Illuminate\Support\Facades\Http;


class TestController extends Controller
{
    use RefeshTokenTrait;

    public function getSoDu()
    {
        $data = ["data" => [
            "acctNo" => "068704070000489"
        ],
            "request" => [
                "requestId" => "a7ea23df-7468-439d-9b12-26eb4a760901",
                "requestTime" => "1667200102200"
            ]];
        return Http::withHeaders([
            'access-token' => 'eyJraWQiOiJXcDRGMndiQVpMa1d2WWgyNDhnYjNtUHBLRzZTdDRNcG85Tmc3U2diZ2E0PSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJmMjY1N2MxNy04ZTdlLTQ3YjItYTk4OS1jZDNlMjY0YWY4ZjgiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLmFwLXNvdXRoZWFzdC0xLmFtYXpvbmF3cy5jb21cL2FwLXNvdXRoZWFzdC0xX1FiMVE4VFBzVSIsImNvZ25pdG86dXNlcm5hbWUiOiJmMjY1N2MxNy04ZTdlLTQ3YjItYTk4OS1jZDNlMjY0YWY4ZjgiLCJvcmlnaW5fanRpIjoiOGM5NWFkYzgtMWU0ZS00ODYxLWFkODUtY2YyOGNkYWIwYTRhIiwiYXVkIjoic2lrY25laTR0MmgzbnRrcWo1ZDQ5bHR2ciIsImV2ZW50X2lkIjoiNzJjMTY3NGEtNTUxOC00N2M0LTgxZDktNDQxNjUyNTYwMmJkIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE2NjkxMjk5MzQsIm5hbWUiOiJUcnVuZyBUaGnhu4duIiwiZXhwIjoxNjY5NDQ0ODA4LCJpYXQiOjE2NjkzNTg0MDgsImp0aSI6IjNiOTA0ZmI1LTkwNDgtNDk0YS1hMWE1LWFiYzk1MDg0ZTU4NSIsImVtYWlsIjoiMjY5LnRkZEBnbWFpbC5jb20ifQ.cWZIqJH_wUnPHVNA5EGtR7J7LJrJldOb4fQq3o-Fqz7n6MKdAvAafREGJdkG839iVsmk_KAZlEwqGyzkza7LqzTI8sT-kq6SobCIixFQpG3EinLAjBaNh-CWPaAb17mhuH4fdAhMf1QGLwVHZcCbgsJ0OqqlRy7i-BmJxGgYoMMD_OgSV8UwE8MQxhD_cFS78bkscmTn6Y5OroLKV8Ef07PdpSrSEDnXQz-mZnDoSV7fxE2T7g1JxH82PPoG3egungVhTfT5t4LsRmQmzQroNudyFAdFc2JvDwoppMOCIMzi99mToq62M8V4aX9kuTwXYB1zkKdp98nu1Ra4AaN72w',
            'x-api-key' => 'hutech_hackathon@123456'
        ])->post('https://7ucpp7lkyl.execute-api.ap-southeast-1.amazonaws.com/dev/balance', $data);
    }
    public function test()
    {


      return $this->registerUser('thiendepssa2triaissai','thiendeptr2aihahahah','emaiasl@gmail.com','0223456789','0923423121','Trung Thien');



    }


}
