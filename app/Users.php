<?php


namespace App;


class Users
{
    private static $usersData = [
        '0' => [
            'id' => 0,
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'role' => 'admin'
        ],

        '1' => [
            'id' => 1,
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
        if (!session()->exists('users')) {
            self::$usersData[0]['password'] =  password_hash('admin', PASSWORD_DEFAULT);
            self::$usersData[1]['password'] =  password_hash('user', PASSWORD_DEFAULT);

            session()->put('users', self::$usersData);
        }
    }


    /**
     * возвращает всю информацию о пользователе прошедшем авторизацию
     *
     * @return array | null информация об авторизованном пользователе либо null
     */
    public static function getAuthorizedUserInfo()
    {
        $authorizedUserId = session()->get('authorizedUserId', null);
        $users = session()->get('users', null);

        if (isset($authorizedUserId) & isset($users)) {
            $result = $users[$authorizedUserId];

            return $result;
        }

        return null;
    }


    /**
     * Возвращает массив зарегистрированных пользователей
     *
     * @return mixed
     */
    public static function getRegisteredUsers() {
        $users = session()->get('users', null);
        return $users;
    }



    /**
     * Выясняет имеет ли пользователь повыщенные права
     *
     * @param $userId
     * @return bool
     */
    public static function isAdmin($userId) {
        if (self::getRegisteredUsers()[$userId]['role'] == 'admin') {
            return true;
        }
        return false;
    }
}
