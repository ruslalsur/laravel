<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Validation\ValidationException;
use Storage;

class NewsCrudResourceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $news = new News();

        return view('admin.addNews',
            [
                'categories' => Category::all(),
                'currentCategory' => session()->get('currentCategory') ?? false,
                'newsOne' => $news,
                'title' => 'Создание новой',
                'rout' => 'admin.news.store',
                'method' => 'POST'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store()
    {
        $news = $this->saveNews(new News());

        return redirect()->route('news.currentCategory',
            $news->category())->with('success', 'Новость добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.addNews',
            [
                'categories' => Category::all(),
                'newsOne' => $news,
                'title' => 'Изменение старой',
                'rout' => 'admin.news.update',
                'method' => 'PUT'
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(News $news)
    {
        $news = $this->saveNews($news);

        return redirect()->route('news.newsOne',
            $news)->with('success', 'Эта новость была только что изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $deletedNewsCategory = $news->category();

        try {
            $news->delete();
        } catch (Exception $e) {
            return redirect()->route('news.currentCategory',
                $deletedNewsCategory)->with('failure', 'Прямо во время удаления произошла ошибка');
        }

        return redirect()->route('news.currentCategory',
            $deletedNewsCategory)->with('success', 'Новость удалена');
    }


    /**
     * сервисный метод для уменьшения дублирования кода
     * заполняет модель данными из реквеста
     * и сохраняет в базу данных
     *
     * @param News $news
     * @return News
     * @throws ValidationException
     */
    private function saveNews(News $news)
    {
        $news->fill($this->validate($this->request, News::rules(), [], News::attributeNames()));

        $image = $news->image ?? asset('storage/images/no-image.png');
        if ($this->request->file('image')) {
            $image = Storage::url(Storage::putFile('public/images', $this->request->file('image')));
        }

        $news->image = $image;
        $news->event_date = date("Y-m-d");
        $news->is_private = $this->request->is_private ? 1 : 0;
        $news->save();

        return $news;
    }
}
