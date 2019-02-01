<?php

namespace App;
use Mail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\ResetsPasswords;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'birth_date', 'phone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public static function generatePassword()
    {
        // Generate random string and encrypt it.
        return bcrypt(str_random(35));
    }

    public static function sendWelcomeEmail($user)
    {
        // Generate a new reset password token
        $token = app('auth.password.broker')->createToken($user);

        // Send email
        Mail::send('resources\views\registerdoctor.blade.php', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->from('rhea.isproj2@gmail.com', 'RHEA');
            $m->to($user->email, $user->first_name, $user->last_name)->subject('Welcome to RHEA');
        });
    }
}
