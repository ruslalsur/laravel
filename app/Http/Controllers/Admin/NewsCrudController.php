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
        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        // создание новой новости
        $newNews['id'] = count($news);
        $newNews['category_id'] = $this->request['categoryId'];
        $newNews['date'] = date('d.m.Y');
        $newNews['isPrivate'] = (boolean)($this->request['isPrivate'] ?? false);
        $newNews['title'] = $this->request['title'];
        $newNews['image'] = $image;
        $newNews['description'] = $this->request['description'];

        //сохранение преобразований
        session()->push('news', $newNews);
        News::saveData();

        return redirect()->route('news.currentCategory', $newNews['category_id'])->with('success', 'Новость добавлена');
    }


    /**
     * Сброс данных сессии
     *
     * @return RedirectResponse
     */
    public function reset()
    {
        session()->flush();

        return redirect()->route('news.home')->with('failure', 'Все данные сессии токашта пропали');
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
                return redirect()->route('news.categories');
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

        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        //изменение уже существующей новости, с возможностью изменения категории, создать категорию можно при создании новости
        foreach ($categories as $category) {
            if ($postCategoryName == $category['name']) {
                $news[$id]['category_id'] = $category['id'];
                $news[$id]['date'] = date('d.m.Y');
                $news[$id]['isPrivate'] = (boolean)($this->request['isPrivate'] ?? false);
                $news[$id]['title'] = $this->request['title'];
                $news[$id]['image'] = $image ?? $news[$id]['image'];
                $news[$id]['description'] = $this->request['description'];

                //сохранение преобразований обратно в сессию
                session()->put('news', $news);
                News::saveData();
            }
        }

        // возврат к списку новостей с произведенными изменениями или без них
        return redirect()->route('news.newsOne', $id)->with('success', 'Вам была предоставлена возможность внести
        изменения в содержание новость, возможно вы ее упустили и оставили все как было');
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
        News::saveData();

        return redirect()->route('news.currentCategory', $delNewsCategory)->with('success', 'Новость удалена');
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

        return redirect()->route('admin.show', $newsId)->with('success', "Создана категория $categoryName");
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
                return redirect()->route('admin.show', $newsId)->with('failure', "Категория $categoryName содержит
                новости, переместите их в другую категорию при помощи редактора новостей и повторите операцию удаления категории");
            }
        }

        unset($categories[$categoryIdToDelete]);
        session()->put('categories', $categories);

        return redirect()->route('admin.show', $newsId)->with('success', "Удалена категория $categoryName");
    }
}
