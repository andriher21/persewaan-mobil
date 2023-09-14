<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('Auth.register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Register successfully');
    }
    public function login(){
        return view('Auth.login');
    }
    public function loginpost(Request $request){
        $data =[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::attempt($data)){
            return redirect('/home');
        }
        return back()->with('error','Email or Password salah');
    }
    /**
     * Summary of logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Kamu berhasil logout');
    }
}
