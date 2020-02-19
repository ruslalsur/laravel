<?php

namespace App\Http\Controllers\NewsAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * регистрация нового пользователя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function reg()
    {
        if (!empty($_POST)) {
            $users = session()->get('users');

            // ряд проверок присланных пользователем данных
            if ($_POST['regPass1'] != $_POST['regPass2'] |
                array_search($_POST['regEmail'], array_column($users, 'email')) != false |
                empty($_POST['regPass1']) | empty($_POST['regPass2'])) {
                return redirect(route('auth.reg'));
            }

            //создание нового пользователя
            $users[] = [
                'email' => $_POST['regEmail'],
                'password' => password_hash($_POST['regPass1'], PASSWORD_DEFAULT),
                'role' => 'user'
            ];

            session()->put('users', $users);

            return redirect(route('auth.login'));
        }

        // отображение формы для ввода регистрационных данных
        return view('newsAuth/reg');
    }


    /**
     * Авторизация пользователя
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        if (!empty($_POST)) {
            $users = session()->get('users');
            $loginingUserLogin = $_POST['logEmail'];
            $authorizedUserId = array_search($loginingUserLogin, array_column($users, 'email'));

            // сохранение идентификатора пользователя прошедшего авторизацию
            if (isset($authorizedUserId)) {
                if (password_verify($_POST['logPassword'], $users[$authorizedUserId]['password'])) {
                    session()->put('authorizedUserId', $authorizedUserId);

                    return redirect(route('admin.list'));
                }
            }
        }
        return view('newsAuth/login');
    }


    /**
     * разлогинивание ранее авторизованного пользователя
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        session()->forget('authorizedUserId');

        return redirect(route('home'));
    }
}
