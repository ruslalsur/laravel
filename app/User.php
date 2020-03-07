<?php

namespace App;

use Auth;
use Auth as AuthAlias;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'is_admin',
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
            'email' => 'required|email',
            'password' => 'string|min:3|nullable',
            'is_admin' => 'sometimes|in:on'
        ];
    }

    public static function attributeNames() {
        return [
            'name' => 'Пользователь',
            'password' => 'Новый пароль',
        ];
    }
}
