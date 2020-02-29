<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\News;
use App\Http\Controllers\Controller;
use App\Users;
use Exception;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.addNews', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(),
            'categories' => Category::all(), 'newsOne' => $newsNew, 'title' => 'Создание новой', 'rout' => 'news.store',
            'method' => 'POST']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $newsNew = new News();

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

        return redirect()->route('news.currentCategory', $newsNew->category())->with('success', 'Новость добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.addNews',
            ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => Category::all(),
                'newsOne' => $news, 'title' => 'Изменение старой', 'rout' => 'news.update', 'method' => 'PUT']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(News $news)
    {
        if ($this->request->file('image')) {
            $image = Storage::putFile('public', $this->request->file('image'));
            $image = Storage::url($image);
        }

        $news->fill($this->request->all());
        if (isset($image)) {$news->image = $image;}
        $news->is_private = $this->request->is_private ? 1 : 0; // патамушта приходит "on", а два делать это уже тогда можно радио
        $news->save();

        return redirect()->route('news.newsOne', $news)->with('success', 'Эта новость была только что изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $deleletedNewsCategory = $news->category();

        try {
            $news->delete();
        } catch (Exception $e) {
        }

        return redirect()->route('news.currentCategory', $deleletedNewsCategory)->with('success', 'Новость удалена');
    }
}
