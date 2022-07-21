<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgetPassword;
use App\Mail\verificationEmail;
use App\Models\User;
use App\traits\responseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Testing\Fakes\MailFake;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{
    use responseTrait;
    public function index(){
        return User::all();
    }

    public function login(LoginRequest $request){
        $fields = $request->validated();
        $user = User::where('email' , $fields['email'])->first();
        if (!$user || !Hash::check($fields['password']  , $user->password)){
            return $this->response(message: 'Bad Creds' , status: 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $message = 'user loggin';
        return $this->response(user: $user ,message: $message , token: $token , status: 201);
    }

    public function register(RegisterRequest $request){
        $fields = $request->validated();
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
//        $this->sendEmailVerification($user);
        $token = $user->createToken('myapptoken')->plainTextToken;
        return $this->response(user: $user , message: 'New user added',token: $token ,status: 201);
    }


    public function sendEmailVerification(User $user){
        $data = [
            'name' => $user->name,
            'id' => Crypt::encrypt($user->id),
        ];
        Mail::to($user)->send(new verificationEmail($data));
    }

    public function verificationEmail($id){
        $id = Crypt::decrypt($id);
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
            'id' => Crypt::encrypt($user->id),
        ];
        Mail::to($user)->send(new ForgetPassword($mailDta));
   }

   public function resetPassword($id){
        return view('Auth.resetPassword')->with('id' , $id);
   }

   public function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'password' => $request->password,
        ]);
        $message = 'all things is up to date';
        return $this->response(message: $message , status: 201);
   }

   public function delete($id){
        $user = User::destroy($id);
        return $this->response(user: $user , message: 'user is deleted' , status: 201);
   }

   public function logout(Request $request){
        auth()->user()->tokens()->delete();
        $message = 'Logged out';
        return $this->response(message: $message , status: 201);
   }

   public function show($id){
      $user = User::find($id);
      return $this->response(user: $user , status: 201);
   }
}
