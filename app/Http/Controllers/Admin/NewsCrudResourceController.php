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
        $newsNew = new News();

        if (!empty($this->request->old())) {
            $newsNew->fill($this->request->old());
        }

//        session()->flash('referer', 'admin/news/create');

        return view('admin.addNews',
            [
                'categories' => Category::all(),
                'currentCategory' => session()->get('currentCategory') ?? false,
                'newsOne' => $newsNew,
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
        $newsNew = new News();

        $newsNew->fill($this->validate($this->request, News::rules(), [], News::attributeNames()));

        $image = null;
        if ($this->request->file('image')) {
            $image = Storage::putFile('public/images', $this->request->file('image'));
            $image = Storage::url($image);
        }

        $newsNew->image = $image;
        $newsNew->event_date = date("Y-m-d");
        $newsNew->is_private = $this->request->is_private ? 1 : 0;
        $newsNew->save();

        return redirect()->route('news.currentCategory',
            $newsNew->category())->with('success', 'Новость добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        if (!empty($this->request->old())) {
            $news->fill($this->request->old());
        }

//        session()->flash('referer', "admin/news/{$news->id}/edit");

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
        $news->fill($this->validate($this->request, News::rules(), [], News::attributeNames()));

        if ($this->request->file('image')) {
            $image = Storage::putFile('public/images', $this->request->file('image'));
            $image = Storage::url($image);
        }

        if (isset($image)) {
            $news->image = $image;
        }
        $news->is_private = $this->request->is_private ? 1 : 0;
        $news->save();

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
}
