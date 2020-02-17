<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class NewsCrudController extends Controller
{
    /**
     * вывод списка новостей для выбора с последующим редактированием
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.adminList', ['news' => News::getAllNews()]);
    }



    /**
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function create($id)
    {
        //чтение данных из сессии
        $categories = \Session::get('categories');
        $news = \Session::get('news');
        $categoryId = $news[$id]['category_id'];
        $newNews = [];

        //добавление новой категории если она была изменена при созданиии новой новости пользователем
        if ($_POST['categoryName'] != $categories[$categoryId]['name']) {
            \Session::push('categories', ['name' => $_POST['categoryName']]);
            $newNews['category_id'] = array_key_last(\Session::get('categories'));
        } else {
            $newNews['category_id'] = $categoryId;
        }

        // создание новой новости
        $newNews['date'] = date('d.m.Y');
        $newNews['isPrivate'] = (boolean)($_POST['isPrivate'] ?? false);
        $newNews['title'] = $_POST['title'];
        $newNews['description'] = $_POST['description'];

        //сохранение преобразований обратно в сессию
        \Session::push('news', $newNews);
        return redirect(route('admin.list'));
    }



    /**
     * Сброс данных сессии надоело делать так "php artisan key:generate",
     * может очень пригодится, когда админ на радостях удалит все новости
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reset()
    {
        \Session::flush();

        return redirect(route('admin.list'));
    }



    /**
     * Отображение формы для внесения изменений администратором
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\View\View
     */
    public function showCrudForm($id)
    {
        return view('admin.editNews',
            ['newsCategoryName' => News::getNewsCategoryName($id), 'id' => $id, 'newsOne' => News::getAllNews()[$id]]);
    }



    /**
     * обработка данных запроса администоратора
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        switch ($_POST['submit']) {
            case 'add':
                $this->create($id);
                break;
            case 'edit':
                $this->update($id);
                break;
            case 'delete':
                $this->destroy($id);
                break;
            default:
                die($_POST['submit']);
        }

        return redirect(route('admin.list'));
    }



    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        //чтение данных из сессии
        $categories = \Session::get('categories');
        $news = \Session::get('news');
        $postCategoryName = $_POST['categoryName'];

        //изменение уже существующей новости, с возможностью изменения категории, создать категорию можно при создании новости
        foreach ($categories as $key => $category) {
            if ($postCategoryName == $category['name']) {
                $news[$id]['category_id'] = $key;
                $news[$id]['date'] = date('d.m.Y');
                $news[$id]['isPrivate'] = (boolean)($_POST['isPrivate'] ?? false);
                $news[$id]['title'] = $_POST['title'];
                $news[$id]['description'] = $_POST['description'];

                //сохранение преобразований обратно в сессию
                \Session::put('news', $news);
            }
        }

        // возврат к списку новостей с произведенными изменениями или без них
        return redirect(route('admin.list'));
    }



    /**
     * удаление, в данный момент редактируемой, новости
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $news = \Session::get('news');
        unset($news[$id]);
        \Session::put('news', $news);

        return redirect(route('admin.list'));
    }
}
