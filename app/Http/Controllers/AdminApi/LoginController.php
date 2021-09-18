<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class LoginController extends Controller
{
    public $loginAfterSignUp = false;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

//    public function login(Request $request)
//    {
//        $userInfo = $request->all();
//        if(isset($userInfo['name']) && $userInfo['name'] == 'fanhuilin'){
//            return json_encode(['message'=>'登录成功'],JSON_UNESCAPED_UNICODE);
//        }else{
//            return json_encode(['message'=>'登录失败'],JSON_UNESCAPED_UNICODE);
//        }
//
//        $headerArr = ['alg' => 'HS256', 'typ' => 'JWT'];
//        $jwtHeader = json_encode($headerArr); // eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9
//
//        $payloadArr = ['sub' => '1234567890', 'name' => 'John Doe', 'iat' => 1516239022];
//        $jwtPayload = json_encode($payloadArr); // eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ
//
//        $encodedString = base64_encode($jwtHeader) . '.' . $this->removeEqual(base64_encode($jwtPayload));
//
//        $signature = hash_hmac('sha256', $encodedString, $this->key, true);
//
//        $token = $encodedString . '.' . $this->removeEqual(base64_encode($signature));
//        return $token;
//    }

    /**
     * [Notes]:  去除字符串的等号(=)
     * [Author]: fanhuilin
     * [Date]:   2021/9/15
     * [Time]:   18:06
     * [Version]:
     * @param $str
     * @return array|string|string[]
     */
//    public function removeEqual($str){
//        return str_replace('=','',$str);
//    }



}
