<?php
namespace App\Http\Controllers;
use App\ApiCallHistory;
use App\Models\DashboardModel;
use Illuminate\Http\Request;
use Validator;

class DashboardController
{
    protected $dashboard;
    public function __construct(DashboardModel $dashboard)
    {
      $this->dashboard = $dashboard;
    }

    public function index(Request $request)
    {
        $date="";
        if(!empty($request->date))
       {
           $validator = Validator::make(request()->input(), [
               'date' => 'required|date_format:m/d/Y',
           ]);
           if ($validator->fails())
           {
               return redirect()->back()
                   ->withErrors($validator)
                   ->withInput();
           }
           $date = date("Y-m-d",strtotime($request->date));


       }

       $res =  $this->dashboard->getUserInfo($date);
       $this->data['user_info']= $res;
      return view('dashboard',$this->data);
    }
}

