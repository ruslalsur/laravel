<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class NewsCrudController extends Controller
{
    /**
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     *
     */
    public function create($id)
    {
        //чтение данных из сессии
        $news = News::getAllNews();
        $newNews = [];

        // создание новой новости
        $newNews['id'] = count($news);
        $newNews['category_id'] = $this->request['categoryId'];
        $newNews['date'] = date('d.m.Y');
        $newNews['isPrivate'] = (boolean)($this->request['isPrivate'] ?? false);
        $newNews['title'] = $this->request['title'];
        $newNews['description'] = $this->request['description'];

        //сохранение преобразований обратно в сессию
        session()->push('news', $newNews);
        return redirect()->route('currentCategory', $newNews['category_id']);
    }


    /**
     * Сброс данных сессии надоело делать так "php artisan key:generate",
     * может очень пригодится, когда админ на радостях удалит все новости
     *
     * @return RedirectResponse
     */
    public function reset()
    {
        session()->flush();

        return redirect()->route('home');
    }


    /**
     * Отображение формы для внесения изменений администратором
     *
     * @param int $id идентификатор новости
     * @return View
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
     * @return Factory|RedirectResponse|Redirector
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
                return redirect()->route('categories');
        }
    }


    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     */
    public function update($id)
    {
        //чтение данных из сессии
        $categories = session()->get('categories');
        $news = session()->get('news');
        $postCategoryName = $categories[$this->request['categoryId']]['name'];

        //изменение уже существующей новости, с возможностью изменения категории, создать категорию можно при создании новости
        foreach ($categories as $key => $category) {
            if ($postCategoryName == $category['name']) {
                $news[$id]['category_id'] = $key;
                $news[$id]['date'] = date('d.m.Y');
                $news[$id]['isPrivate'] = (boolean)($this->request['isPrivate'] ?? false);
                $news[$id]['title'] = $this->request['title'];
                $news[$id]['description'] = $this->request['description'];

                //сохранение преобразований обратно в сессию
                session()->put('news', $news);
            }
        }

        // возврат к списку новостей с произведенными изменениями или без них
        return redirect()->route('newsOne', $id);
    }


    /**
     * удаление новости
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $news = session()->get('news');
        $delNewsCategory = $news[$id]['category_id'];
        unset($news[$id]);
        session()->put('news', $news);

        return redirect()->route('currentCategory', $delNewsCategory);
    }


    /**
     * добавление категорий
     *
     *
     * @param $categoryName
     * @param $newsId
     * @return Factory|RedirectResponse|Redirector|View
     */
    private function categoryCreator($categoryName, $newsId)
    {
        $categories = News::getAllCategories();

        if (empty($categoryName)) {
            return view('admin.categoryCreator', ['categories' => $categories, 'newsId' => $newsId]);
        }

        if (array_search($categoryName, array_column($categories, 'name'))) {
            return redirect()->route('admin.show', $newsId);
        }

        $newId = count($categories);
        $categories[] = ['id' => $newId, 'name' => $categoryName];
        session()->put('categories', $categories);

        return redirect()->route('admin.show', $newsId);
    }


    /**
     *  удаление категорий
     *
     * @param $categoryName
     * @param $newsId
     * @return RedirectResponse|Redirector
     */
    private function categoryEraser($categoryName, $newsId)
    {
        $categories = News::getAllCategories();
        $news = News::getAllNews();
        $categoryIdToDelete = null;

        foreach ($categories as $key => $category) {
            if ($categoryName == $category['name']) {
                $categoryIdToDelete = $key;
                break;
            }
        }

        //еслии категория не пуста, не производить удаление категории
        foreach ($news as $key => $newsOne) {
            if ($categoryIdToDelete == $newsOne['category_id']) {
                return redirect()->route('admin.show', $newsId);
            }
        }

        unset($categories[$categoryIdToDelete]);
        session()->put('categories', $categories);

        return redirect()->route('admin.show', $newsId);
    }
}
