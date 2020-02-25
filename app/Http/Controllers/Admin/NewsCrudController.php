<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NewsCrudController extends Controller
{
    /**
     * Отображение формы для внесения изменений администратором
     *
     * @param int $id идентификатор новости
     * @return View
     */
    public function showCrudForm($id)
    {
        $newsOne = News::getNewsOne($id);

        return view('admin.editNews',
            ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getCategories(),
                'currentCategoryName' => News::getCategory($newsOne->category_id)->name, 'newsOne' => $newsOne]);
    }


    /**
     * как то незаметно для себя написал маршрутизатор, надо убрать потом
     *
     * @param int $id идентификатор новости
     * @return Factory|RedirectResponse|Redirector
     */
    public function edit($id)
    {
        switch ($this->request['submit']) {
            case 'newCategory':
                return view('admin.categoryCreator', ['categories' => News::getCategories(), 'newsId' => $id]);
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
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     *
     */
    public function create($id)
    {
        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        $newNews = [];
        $newNews['category_id'] = $this->request['categoryId'];
        $newNews['date'] = date('Y-m-d');
        $newNews['isPrivate'] = (boolean)($this->request['isPrivate'] ?? false);
        $newNews['title'] = $this->request['title'];
        $newNews['image'] = $image;
        $newNews['description'] = $this->request['description'];

        DB::table('news')->insert($newNews);

        return redirect()->route('news.currentCategory', $newNews['category_id'])->with('success', 'Новость добавлена');
    }


    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     */
    public function update($id)
    {
        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        $updateData = [
            'category_id' => $this->request['categoryId'],
            'date' => date('Y.m.d'),
            'isPrivate' => (boolean)($this->request['isPrivate'] ?? false),
            'title' => $this->request['title'],
            'image' => $image ?? News::getNewsOne($id)->image,
            'description' => $this->request['description']
        ];

        DB::table('news')->where('id', $id)->update($updateData);

        return redirect()->route('news.newsOne', $id)->with('success', 'Эта новость была только что изменена');
    }


    /**
     * удаление новости
     *
     * @param int $id идентификатор новости
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $deleletedNewsCategory = News::getNewsOne($id)->category_id;
        DB::table('news')->delete($id);

        return redirect()->route('news.currentCategory', $deleletedNewsCategory)->with('success', 'Новость удалена');
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
        if (News::createCategory($categoryName)) {
            return view('admin.categoryCreator', ['categories' => News::getCategories(), 'newsId' => $newsId]);
        }

        return view('admin.categoryCreator', ['categories' => News::getCategories(), 'newsId' => $newsId]);
    }


    /**
     *  удаление категорий
     *
     * @param $categoryName
     * @param $newsId
     * @return Factory|View
     */
    private function categoryEraser($categoryName, $newsId)
    {
        if (News::deleteCategory($categoryName)) {
            return view('admin.categoryCreator', ['categories' => News::getCategories(), 'newsId' => $newsId]);
        }

//        return redirect()->route('admin.categoryCreator', $newsId)->with('failure', "Ошибка удаления категории $categoryName");
        return view('admin.categoryCreator', ['categories' => News::getCategories(), 'newsId' => $newsId]);
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
}
