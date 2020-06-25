<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ApiCallHistory;
use App\OauthAccessToken;
use Auth;
use Validator;


class ApiCallHistoryController extends Controller
{

   public function __construct()
   {

   }

   public function apiCall()
   {
       try {
           $api_call_history = new ApiCallHistory();
           $api_call_history->user_id = Auth::user()->id;
           $api_call_history->created_at = date("Y-m-d H:i:s");
           $api_call_history->save();
           $success['status'] = config('constants.success');
           $success['message'] = 'Api call successfully';
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
