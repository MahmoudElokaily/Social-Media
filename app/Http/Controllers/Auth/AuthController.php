<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\verificationEmail;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;

class AuthController extends Controller
{
    public function login(){
        return view('Auth.login');
    }

    public function check(Request $request){
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email' , $email)->get()->first();

        if (!$user || $user->password != $password)
            return redirect()->back()->with('error' , 'email or password are uncorrect');
        else {
            Auth::login($user);
            return 'Success';
        }
    }

    public function register(){
        return view('Auth.register');
    }

    public function store(Request $request){
        if ($request->password1 != $request->password2)
            return redirect()->back()->with('error' , 'password does not match');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password1,
        ]);
        $user = User::orderBy('created_at', 'desc')->first();
        $this->sendEmailVerification($user);
        return redirect()->back()->with('success' , 'user are registered');
    }

    public function sendEmailVerification(User $user){
        $data = [
            'name' => $user->name,
            'id' => $user->id,
        ];
        Mail::to('example@example.com')->send(new verificationEmail($data));
    }

    public function verificationEmail($id){
        $user = User::find($id);
        $user->email_verified_at = now()->timestamp;
        return 'Success';
   }
}
