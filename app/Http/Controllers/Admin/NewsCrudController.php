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
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @param int $id идентификатор новости
     * @return Factory|RedirectResponse|View
     *
     */
    public function create()
    {
        if ($this->request->isMethod('get')) {

            return view('admin.addNews', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(),'categories' => News::getCategories()]);
        }

        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        $newNews = [
            'category_id' => $this->request['categoryId'],
            'created_at' => date('Y-m-d'),
            'isPrivate' => (boolean)($this->request['isPrivate'] ?? false),
            'title' => $this->request['title'],
            'image' => $image,
            'description' => $this->request['description'],
        ];

        DB::table('news')->insert($newNews);

        return redirect()->route('news.currentCategory', $newNews['category_id'])->with('success', 'Новость добавлена');
    }


    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function update($id)
    {
        if ($this->request->isMethod('get')) {
            $newsOne = News::getNewsOne($id);

            return view('admin.editNews',
                ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getCategories(),
                    'currentCategoryName' => News::getCategory($newsOne->category_id)->name, 'newsOne' => $newsOne]);
        }

        $image = null;
        if ($this->request->file('image')) {
            $image = \Storage::putFile('public', $this->request->file('image'));
            $image = \Storage::url($image);
        }

        $updateData = [
            'category_id' => $this->request['categoryId'],
            'updated_at' => date('Y.m.d'),
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
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function categoryCreator()
    {
        if ($this->request->isMethod('get')) {
            return view('admin.categoryCreator', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(),'categories' => News::getCategories()]);
        }

        switch ($this->request['submit']) {

            case 'addCategory':
                if (News::createCategory($this->request['newCategoryName'])) {
                    return redirect()->route('admin.categoryCreator')->with('success', 'Была создана категория ' . $this->request['newCategoryName']);
                }
                return redirect()->route('admin.categoryCreator')->with('failure', 'Ошибка создания категории ' . $this->request['newCategoryName']);

            case 'delCategory':
                if (News::deleteCategory($this->request['newCategoryName'])) {
                    return redirect()->route('admin.categoryCreator')->with('success', 'Была удалена категория ' . $this->request['newCategoryName']);
                }
                return redirect()->route('admin.categoryCreator')->with('failure', 'Ошибка удаления категории ' . $this->request['newCategoryName']);
        }
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
