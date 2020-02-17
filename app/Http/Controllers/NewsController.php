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
        return view('categories', ['categories' => News::getAllCategories()]);
    }


    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        $currentCategoryNews = [];
        if (array_key_exists($category_id, News::getAllCategories())) {
            foreach (News::getAllNews() as $key => $newsOne) {
                if ($newsOne['category_id'] == $category_id) {
                    $newsOne['id'] = $key;
                    $currentCategoryNews[] = $newsOne;
                }
            }

            return view('currentCategoryNews',
                [
                    'category_id' => $category_id,
                    'currentCategoryName' => News::getAllCategories()[$category_id]['name'], 'currentCategoryNews' => $currentCategoryNews
                ]);
        }
        return $this->showAllCategories();
    }


    /**
     * Отображение одной новости по переданному идентификатору
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewsOne($id)
    {
        if (array_key_exists($id, News::getAllNews())) {
            $currentCategoryName = News::getNewsCategoryName($id);

            return view('newsOne',
                ['categoryName' => $currentCategoryName, 'newsOne' => News::getAllNews()[$id]]);
        }
        return $this->showAllCategories();

    }
}
