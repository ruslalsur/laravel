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

        return view('categories', ['categories' => $categories]);
    }


    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        $categoriesData = News::getCategoriesData();
        $newsData = News::getNewsData();
        $currentCategoryNews = [];

        if (array_key_exists($category_id, $categoriesData)) {
            foreach($newsData as $key => $newsOne) {
                if ($newsOne['category_id'] == $category_id) {
                    $newsOne['id'] = $key;
                    $currentCategoryNews[] = $newsOne;
                }
            }

            return view('currentCategoryNews',
                [
                    'category_id' => $category_id,
                    'currentCategoryName' => $categoriesData[$category_id]['name'], 'currentCategoryNews' => $currentCategoryNews
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
        $categories = News::getCategoriesData();
        $news = News::getNewsData();

        if (array_key_exists($id, $news)) {
            $currentCategoryName = News::getNewsCategoryName($id);
            return view('newsOne',
                ['categoryName' => $currentCategoryName, 'newsOne' => $news[$id]]);
        }
        return $this->showAllCategories();

    }
}
