<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class UserCrudResourceController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('profVal');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.users', [
            'users' => (new User())->newQuery()->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.profile', [
            'user' => new User(),
            'title' => 'Создание нового пользователя',
            'route' => 'admin.user.store',
            'method' => 'POST',
            'showIsAdmin' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store()
    {
        $user = new User();
        $name = $this->resourceComponent($user);

        return redirect()->route('admin.user.index')->with('success', "Создан пользователь {$name}");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('auth.profile', [
            'user' => $user,
            'title' => 'Редактирование профиля пользователя',
            'route' => 'admin.user.update',
            'method' => 'PUT',
            'showIsAdmin' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $name = $this->resourceComponent($user);
        return redirect()->route('admin.user.index')->with('success', "Данные пользователя {$name} были изменены");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $deletedUser = $user->name;

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->route('admin.user.index')
                ->with('failure', "Прямо во время удаления пользователя {$deletedUser} произошла ошибка");
        }

        return redirect()->route('admin.user.index')->with('success', "Пользователь {$deletedUser} успешно удален");
    }

    /**
     * сервисный метод для уменьшения дублирования кода
     * заполняет модель данными из реквеста
     * и сохраняет в базу данных
     *
     * @param User $user
     * @return string
     */
    public function resourceComponent(User $user)
    {
        $image = asset('/img/user.png');

        if ($this->request->file('image')) {
            $image = Storage::putFile('public', $this->request->file('image'));
            $image = Storage::url($image);
        }

        $user->fill([
            'name' => $this->request->post('name'),
            'email' => $this->request->post('email'),
            'avatar' => $image,
            'is_admin' => $this->request->post('is_admin') ? 1 : 0,
            'password' => Hash::make($this->request->post('password'))
        ]);
        $user->save();

        return $user->name;
    }
}
