<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\OauthAccessToken;
use Auth;
use Validator;
use Lcobucci\JWT\Parser;


class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',

            ]);
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $key => $value) {
                    $error_message = $value;
                    break;
                }
                $error['status'] = config('constants.error');
                $error['message'] = $error_message;
                return response()->json($error);
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                info("login user is verified and whose user id is " . Auth::user()->id);
                if (Auth::check() && Auth::user()->role != "user") {
                    info("login user is deleted and whose user id is " . Auth::user()->id);
                    Auth::logout();
                    $error['status'] = config('constants.error');
                    $error['message'] = "Your account does not exist.";
                    return response()->json($error);
                }

                $user_detail = Auth::user()->fresh();
                $user_detail['token'] = 'Bearer ' . $user_detail->createToken(request('email'))->accessToken;
                $success['status'] = config('constants.success');
                $success['data'] = array('user_detail' => $user_detail);
                $success['message'] = 'User login successfully';
                return response()->json($success);
            } else {
                $error['status'] = config('constants.error');
                $error['message'] = "Invalid user name and password";
                return response()->json($error);
            }
        } catch (\Exception $e) {
            info("Exception of signin user " . $e->getMessage());
            $error['status'] = config('constants.error');
            $error['message'] = $e->getMessage();
            return response()->json($error);
        }

    }


    public function signOut(Request $request)
    {
        try
        {
            $user_data = Auth::user();
            $token     = $request->bearerToken();
            $token_id  = (new Parser())->parse($token)->getHeader('jti');
            OauthAccessToken::where('id',$token_id)->delete();
            info('access token deleted successfully');
            $success['status'] = config('constants.success');
            $success['message'] =  'User logout successfully';
            return response()->json($success);
        }
        catch (\Exception $e)
        {
            info("Exception of signout user ". $e->getMessage());
            $error['status'] = config('constants.error');
            $error['message'] = $e->getMessage();
            return response()->json($error);
        }
    }

}
