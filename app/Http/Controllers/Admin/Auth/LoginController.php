<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class LoginController extends Controller
{
    public function getLogin(){
        return view('Admin.auth.login');
    }

    public function postLogin(Request $request){
        $messages = [
            'email.required' => 'Email không được bỏ trống',
            'email.email' =>'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu phải hơn 6 ký tự',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required | min:6',
        ], $messages);

        if ($validator->fails()) {
                foreach ($validator->errors()->all() as $value) {
                return redirect()->back()->with(['flag_message'=>'error', 'message'=>$value]);
            }
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            if($user->status == 1){
                return redirect()->route();
            }else{
                return redirect()->back()->with(['flag_message' => 'error', 'message'=>'Tài khoản bị khoá']);
            }       
        }
        else{ 
            return redirect()->back()->with(['flag_message' => 'error', 'message'=>'Email hoặc Password không tồn tại']);
        } 
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
