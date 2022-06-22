<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgetPassword;
use App\Mail\verificationEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    public function login(){
        return view('Auth.login');
    }

    public function check(Request $request){
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email' , $email)->get()->first();

        if (!$user || !Hash::check($password , $user->password))
            return redirect()->back()->with('error' , 'email or password are uncorrect');
        else {
            Auth::login($user);
            dd( 'Success');
        }
    }

    public function register(){
        return view('Auth.register');
    }

    public function store(RegisterRequest $request){
        if ($request->password1 != $request->password2)
            return redirect()->back()->with('error' , 'password does not match');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password1),
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
        Mail::to($user)->send(new verificationEmail($data));
    }

    public function verificationEmail($id){
        $user = User::find($id);
        $user->update([
            'email_verified_at' => Carbon::now()->timestamp,
        ]);
        dd('Success');
   }

   public function forgetPassword(){
        return view('Auth.forget');
   }

   public function sendPasswordMail(Request $request){
        $user = User::where('email' , $request->email)->get()->first();
        if (!$user)
            return redirect()->back()->with('error' , 'the email can not found');
        $this->forgetPasswordEmail($user);
        dd('Please,Check your mail');

   }

   public function forgetPasswordEmail($user){
        $mailDta = [
          'name' => $user->name,
            'id' => $user->id,
        ];
        Mail::to($user)->send(new ForgetPassword($mailDta));
   }

   public function resetPassword($id){
        return view('Auth.resetPassword')->with('id' , $id);
   }

   public function updatePassword(Request $request){
        $user = User::find($request->id);
       if (!$user || $request->password1 != $request->password2)
           return redirect()->back()->with('error' , 'password does not match');
       $user->update([
           'password' => Hash::make($request->password1),
       ]);
       dd('Password change Successfully');
   }
}
