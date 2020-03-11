<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'social_id', 'auth_type', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Правила валидации
     *
     * @return array
     */
    public static function rules() {
        return [
            'name' => 'required|string|min:5|max:50',
            'email' => "required|email",
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
            'is_admin' => 'sometimes|in:on'
        ];
    }

    public static function attributeNames() {
        return [
            'name' => 'пользователь',
            'email' => '@email',
            'password' => 'пароль',
            'password_confirmation' => 'повтор',
        ];
    }
}
