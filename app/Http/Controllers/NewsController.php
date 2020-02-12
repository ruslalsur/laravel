<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Отображение списка всех категорий
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllCategories()
    {
        $categories = News::getCategoriesData();

        return view('categories', ['title' => 'Категории', 'categories' => $categories]);
    }


    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        $categories = News::getCategoriesData();
        $news = News::getNewsData();

        if (array_key_exists($category_id, $categories)) {
            return view('currentCategoryNews',
                [
                    'title' => 'Новости', 'category_id' => $category_id,
                    'categoryName' => $categories[$category_id]['name'], 'news' => $news
                ]);
        }
        return redirect(route('categories'));

    }


    /**
     * Отображение одной новости по переданному идентификатору
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewsOne($id)
    {
        $categories = News::getCategoriesData();
        $news = News::getNewsData();

        if (array_key_exists($id, $news)) {
            $currentCategoryName = $categories[$news[$id]['category_id']]['name'];
            return view('newsOne',
                ['title' => 'Новость', 'categoryName' => $currentCategoryName, 'newsOne' => $news[$id]]);
        }
        return redirect(route('categories'));
    }
}
