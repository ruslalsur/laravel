<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Users;
use App\Http\Controllers\Controller;

class NewsCrudController extends Controller
{
    /**
     * вывод списка новостей для выбора с последующим редактированием
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.adminList', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getAllCategories(), 'news' => News::getAllNews()]);
    }


    /**
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Routing\Redirector
     *
     */
    public function create($id)
    {
        //чтение данных из сессии
        $categories = News::getAllCategories();
        $news = News::getAllNews();
        $newNews = [];

        // создание новой новости
        $newNews['id'] = count($news);
        $newNews['category_id'] = $_POST['categoryId'];
        $newNews['date'] = date('d.m.Y');
        $newNews['isPrivate'] = (boolean)($_POST['isPrivate'] ?? false);
        $newNews['title'] = $_POST['title'];
        $newNews['description'] = $_POST['description'];

        //сохранение преобразований обратно в сессию
        session()->push('news', $newNews);
        return redirect(route('admin.list'));
    }


    /**
     * Сброс данных сессии надоело делать так "php artisan key:generate",
     * может очень пригодится, когда админ на радостях удалит все новости
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function reset()
    {
        session()->flush();

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
        $categoryId = News::getAllNews()[$id]['category_id'];
        return view('admin.editNews',
            ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getAllCategories(),
                'currentCategoryName' => News::getNewsCategoryName($categoryId), 'newsId' => $id, 'newsOne' => News::getAllNews()[$id]]);
    }


    /**
     * обработка данных запроса администоратора
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Contracts\View\Factory | \Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        switch ($this->request['submit']) {
            case 'newCategory':
                return view('admin.categoryCreator', ['categories' => News::getAllCategories(), 'newsId' => $id]);
                break;

            case 'addCategory':
                $categoryName = $this->request['newCategoryName'];
                return $this->categoryCreator($categoryName, $id);
                break;

            case 'delCategory':
                $categoryName = $this->request['newCategoryName'];
                return $this->categoryEraser($categoryName, $id);
                break;

            case 'add':
                return $this->create($id);
                break;

            case 'edit':
                return $this->update($id);
                break;

            case 'delete':
                return $this->destroy($id);
                break;

            default:
                return redirect(route('admin.list'));
        }
    }


    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        //чтение данных из сессии
        $categories = session()->get('categories');
        $news = session()->get('news');
        $postCategoryName = $categories[$_POST['categoryId']]['name'];

        //изменение уже существующей новости, с возможностью изменения категории, создать категорию можно при создании новости
        foreach ($categories as $key => $category) {
            if ($postCategoryName == $category['name']) {
                $news[$id]['category_id'] = $key;
                $news[$id]['date'] = date('d.m.Y');
                $news[$id]['isPrivate'] = (boolean)($_POST['isPrivate'] ?? false);
                $news[$id]['title'] = $_POST['title'];
                $news[$id]['description'] = $_POST['description'];

                //сохранение преобразований обратно в сессию
                session()->put('news', $news);
            }
        }

        // возврат к списку новостей с произведенными изменениями или без них
        return redirect(route('admin.list'));
    }


    /**
     * удаление новости
     *
     * @param int $id идентификатор новости
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $news = session()->get('news');
        unset($news[$id]);
        session()->put('news', $news);

        return redirect(route('admin.list'));
    }


    /**
     * добавление категорий
     *
     *
     * @param $categoryName
     * @return \Illuminate\Routing\Redirector
     */
    private function categoryCreator($categoryName, $newsId)
    {
        $categories = News::getAllCategories();

        if (!empty($categoryName)) {
            if (!array_search($categoryName, array_column($categories, 'name'))) {
                $newId = count($categories);
                $categories[] = ['id' => $newId, 'name' => $categoryName];

                session()->put('categories', $categories);
            }
        }

        return redirect(route('admin.show', $newsId));
    }


    /**
     *  удаление категорий
     *
     * @param $categoryName
     * @return \Illuminate\Routing\Redirector
     */
    private function categoryEraser($categoryName, $newsId)
    {
        $categories = News::getAllCategories();
        $news = News::getAllNews();
        $newsCut = $news;
        $categoryIdToDelete = null;

        foreach ($categories as $key => $category) {
            if ($categoryName == $category['name']) {
                $categoryIdToDelete = $key;
                break;
            }
        }

        if (isset($categoryIdToDelete)) {
            foreach ($news as $key => $newsOne) {
                if ($categoryIdToDelete == $newsOne['category_id']) {
                    unset($newsCut[$key]);
                }
            }
        }

        unset($categories[$categoryIdToDelete]);
        session()->put('categories', $categories);
        session()->put('news', $newsCut);

        return redirect(route('admin.show', $newsId));
    }
}
