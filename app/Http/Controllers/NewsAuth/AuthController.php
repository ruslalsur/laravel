<?php

namespace App\Http\Controllers\NewsAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use App\Users;

class AuthController extends Controller
{
    /**
     * регистрация нового пользователя
     *
     * @return RedirectResponse|Redirector|View
     */
    public function reg()
    {
        if ($this->request->isMethod('post')) {
            $users = session()->get('users');

            // ряд проверок присланных пользователем данных надо будет разделить для возврата разных сообщений
            if ($this->request['regPass1'] != $this->request['regPass2'] |
                array_search($this->request['regEmail'], array_column($users, 'email')) != false |
                empty($this->request['regPass1']) | empty($this->request['regPass2'])) {
                $this->request->flash();

                return redirect()->route('auth.reg')->with('failure', 'Пользователь уже существует либо пароли не совпадают');
            }

            //создание нового пользователя
            $users[] = [
                'id' => count($users),
                'email' => $this->request['regEmail'],
                'password' => password_hash($this->request['regPass1'], PASSWORD_DEFAULT),
                'role' => 'user'
            ];

            session()->put('users', $users);
            Users::saveData();

            return redirect()->route('auth.login')->with('success', 'Регистрация завершена успешно! Авторизуйтесь.');
        }

        // отображение формы для ввода регистрационных данных
        return view('newsAuth/reg');
    }


    /**
     * Авторизация пользователя
     *
     * @return RedirectResponse|Redirector|View
     */
    public function login()
    {
        if ($this->request->isMethod('post')) {
            $this->request->flash();
            $users = Users::getRegisteredUsers();
            $authorizedUserId = null;

            //сравнение введенного логина
            foreach ($users as $user) {
                if ($user['email'] == $this->request['logEmail']) {
                    $authorizedUserId = $user['id'];
                }
            }

            //сравнение введеного пароля
            if (isset($authorizedUserId)) {
                if (password_verify($this->request['logPassword'], $users[$authorizedUserId]['password'])) {
                    session()->put('authorizedUserId', $authorizedUserId);

                    //полное совпадение
                    return redirect()->route('news.categories')->with('success', 'Авторизация прошла успешно.
                    Теперь доступен просмотр всех новостей');
                }

                //пароль не совпал
                return redirect()->route('auth.login')->with('failure', 'Неверный пароль');
            }

            //логин не совпал
            return redirect()->route('auth.reg')->with('failure', 'Нет такого пользователя, зарегистрируйте его');
        }

        return view('newsAuth/login');
    }


    /**
     * разлогинивание ранее авторизованного пользователя
     *
     * @return RedirectResponse|Redirector
     */
    public function logout()
    {
        session()->forget('authorizedUserId');

        return redirect()->route('news.categories')->with('success', 'Вышел!');
    }
}
