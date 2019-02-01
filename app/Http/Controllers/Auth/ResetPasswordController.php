<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forget(Request $request)
    {

        $password = $request->password;

        $token = bcrypt($request->token);
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();
        dd($token);
        $user = Users::where('email', $tokenData->email)->first();
        if ( !$user ) return redirect()->to('/dashboard');

        $user->password = Hash::make($password);
        $user->update(); //or $user->save();
        DB::table('password_resets')->where('email', $user->email)->delete();
        return redirect('/login');
    }
}
