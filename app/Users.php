<?php


namespace App;


class Users
{
    private static array $usersData = [
        '0' => [
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'role' => 'admin'
        ],

        '1' => [
            'email' => 'user@user.com',
            'password' => 'user',
            'role' => 'user'
        ],
    ];


    /**
     * запись данных  в глобальный массив, если там их еще нету,
     * вызывается в конструкторе базового контролера
     *
     */
    public static function init()
    {
        // вы говорили, что там где то уже сессия стартует, но для наглядности пока не стал убирать
        if (!\Session::isStarted()) {
            \Session::start();
        }

        if (!\Session::exists('users')) {
            self::$usersData[0]['password'] =  password_hash('admin', PASSWORD_DEFAULT);
            self::$usersData[1]['password'] =  password_hash('user', PASSWORD_DEFAULT);

            \Session::put('users', self::$usersData);
        }
    }


    /**
     * возвращает информацию о пользователе прошедщем авторизацию
     *
     * @return array | null информация об авторизованном пользователе либо null
     */
    public static function getAuthorizedUserInfo()
    {
        $authorizedUserId = \Session::get('authorizedUserId', null);
        $users = \Session::get('users', null);

        if (isset($authorizedUserId) & isset($users)) {
            $result = $users[$authorizedUserId];
            $result['id'] = $authorizedUserId;
            return $result;
        }
        return null;
    }
}
