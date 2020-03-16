<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCrudResourceController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('profVal');
        parent::__construct($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        session()->flash('referer', 'admin/user');
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
        $name = $this->userCRUDComponent($user);

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
        $name = $this->userCRUDComponent($user);
        return redirect()->route('admin.user.index')->with('success', "Данные пользователя {$name} были изменены");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $deletingUser = $user->name;

        if (!$this->request->exists('confirmed')) {
            session()->flash('confirm', $user->id);

            return view('admin.users', ['users' => (new User())->newQuery()->paginate(12)]);
        }

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->route('admin.user.index')
                ->with('failure', "Прямо во время удаления пользователя {$deletingUser} произошла ошибка");
        }

        return redirect()->route('admin.user.index')->with('success', "Пользователь {$deletingUser} успешно удален");
    }
}
