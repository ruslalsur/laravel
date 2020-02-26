<?php


namespace App;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Storage;

class Users
{
    /**
     * запись данных  в глобальный массив, если там их еще нету,
     * вызывается в конструкторе базового контролера
     *
     */
    public static function init()
    {
        if (!session()->exists('users')) {
          session()->put('users', self::loadUsersData());
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

            return $users[$authorizedUserId];
        }

        return null;
    }


    /**
     * Возвращает массив зарегистрированных пользователей
     *
     * @return mixed
     */
    public static function getRegisteredUsers() {
        return session()->get('users', null);
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


    /**
     * загрузка данных из файла c пользователями
     * @return array
     * @throws FileNotFoundException
     */
    public static function loadUsersData()
    {
        return json_decode(Storage::disk('local')->get('users.json'), true);
    }


    /**
     * сохранение изменений на диск вызывается, например, при регистрации нового пользователя
     */
    public static function saveData()
    {
        if (session()->exists('users')) {
            $registeredUsers = json_encode(self::getRegisteredUsers(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            Storage::disk('local')->put('users.json', $registeredUsers);
        }
    }
}
