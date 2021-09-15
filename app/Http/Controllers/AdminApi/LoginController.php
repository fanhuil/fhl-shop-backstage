<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $key = 123456;

    public function login(Request $request)
    {
        $userInfo = $request->all();
//        if(isset($userInfo['name']) && $userInfo['name'] == 'fanhuilin'){
//            return json_encode(['message'=>'登录成功'],JSON_UNESCAPED_UNICODE);
//        }else{
//            return json_encode(['message'=>'登录失败'],JSON_UNESCAPED_UNICODE);
//        }

        $headerArr = ['alg' => 'HS256', 'typ' => 'JWT'];
        $jwtHeader = json_encode($headerArr); // eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9

        $payloadArr = ['sub' => '1234567890', 'name' => 'John Doe', 'iat' => 1516239022];
        $jwtPayload = json_encode($payloadArr); // eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ


        $encodedString = base64_encode($jwtHeader) . '.' . $this->removeEqual(base64_encode($jwtPayload));

        $signature = hash_hmac('sha256', $encodedString, $this->key, true);

        $token = $encodedString . '.' . $this->removeEqual(base64_encode($signature));

        return $token;
    }

    public function removeEqual($str){
        return str_replace('=','',$str);
    }
}
