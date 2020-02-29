<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Storage;

class NewsCrudController extends Controller
{
    /**
     * Создание новой новости и/или новой категории вместе с ней
     *
     * @return Factory|RedirectResponse|View
     *
     */
    public function create()
    {
        $newsNew = new News();

        if ($this->request->isMethod('get')) {
            return view('admin.addNews', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(),
                'categories' => Category::all(), 'newsOne' => $newsNew, 'title' => 'Создание новой', 'rout' => 'admin.add']);
        }

        $image = null;
        if ($this->request->file('image')) {
            $image = Storage::putFile('public', $this->request->file('image'));
            $image = Storage::url($image);
        }

        $newsNew->fill($this->request->all());
        $newsNew->image = $image;
        $newsNew->event_date = date("Y-m-d");
        $newsNew->is_private = $this->request->is_private ? 1 : 0;
        $newsNew->save();

        return redirect()->route('news.currentCategory', $newsNew['category_id'])->with('success', 'Новость добавлена');
    }


    /**
     * изменение новости
     *
     * @param int $id идентификатор новости
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function update(News $news)
    {
        if ($this->request->isMethod('get')) {

            return view('admin.addNews',
                ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => Category::all(),
                    'newsOne' => $news, 'title' => 'Изменение старой', 'rout' => 'admin.edit']);
        }

        if ($this->request->file('image')) {
            $image = Storage::putFile('public', $this->request->file('image'));
            $image = Storage::url($image);
        }

        $news->fill($this->request->all());
        if (isset($image)) {$news->image = $image;}
        $news->is_private = $this->request->is_private ? 1 : 0; // патамушта приходит "on", а два делать это уже тогда можно радио
        $news->save();

        return redirect()->route('news.newsOne', $news->id)->with('success', 'Эта новость была только что изменена');
    }


    /**
     * удаление новости
     *
     * @param News $news модель новости
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $deleletedNewsCategory = $news->category;
        $news->delete();

        return redirect()->route('news.currentCategory', $deleletedNewsCategory)->with('success', 'Новость удалена');
    }


    /**
     * добавление и удаление категорий
     *
     * @return Factory|RedirectResponse|Redirector|View
     * @throws \Exception
     */
    public function categoryCreator()
    {
        if ($this->request->isMethod('get')) {
            return view('admin.categoryCreator', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => Category::all()]);
        }

        if ($this->request->newCategoryName === null) {
            return redirect()->route('admin.categoryCreator')->with('failure', 'Нужно ввести название категории,
            чтобы удалить или добавть ее в список категорий');
        }

        switch ($this->request['submit']) {
            case 'addCategory':
                if (Category::query()->where('name', $this->request->newCategoryName)->exists()) {
                    return redirect()->route('admin.categoryCreator')->with('failure', 'Категория "' . $this->request['newCategoryName'] . '" уже существует');
                }

                $category = new Category();
                $category->name = $this->request->newCategoryName;
                $category->save();

                return redirect()->route('admin.categoryCreator')->with('success', 'Была создана категория ' . $this->request['newCategoryName']);

            case 'delCategory':
                $targetCategory = Category::query()->where('name', $this->request->newCategoryName)->first();

                if ($targetCategory->news()->exists()) {
                    return redirect()->route('admin.categoryCreator')->with('failure', 'Категория "' .
                        $this->request['newCategoryName'] . '" содержит новости, нужно удалить из нее новости, перед удалением категории');
                }

                $targetCategory->delete();
                return redirect()->route('admin.categoryCreator')->with('success', 'Была удалена категория ' . $this->request['newCategoryName']);
        }
    }
}
