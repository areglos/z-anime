<?php

namespace App\Http\Controllers\Theme;

use Illuminate\Http\Request;
use Auth, Socialite, Validator;
use Illuminate\Support\Str;
use App\Models\User;
class AuthUser extends Controller
{   
    public function getSignIn() {
        return view('theme.pages.signin');
    }

    public function postSignIn (Request $request) {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->with(['msg' => 'Thông tin không hợp lệ']);
        } 
        else { 
            $email = $request->email;
            $password = $request->password;

            if( Auth::attempt(['email' => $email, 'password' => $password])) {
            	// if (Auth::user()->active == 0) {
            	// 	Auth::logout();
            	// 	return response()->json(['msg' => 'Tài khoản của bạn đã bị khoá bởi quản trị viên'], 401);
            	// }
                return redirect()->route('theme.home');
            } 
            else {
                return redirect()->back()->with(['msg' => 'Email hoặc mật khẩu không đúng']);
            }
        }
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('theme.home');
    }
}
