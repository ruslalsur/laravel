<?php

namespace App\Http\Controllers;

use App\News;
use App\Users;

class NewsController extends Controller
{
    /**
     * Отображение списка всех категорий
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllCategories()
    {
        return view('categories', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getAllCategories()]);
    }


    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        return view('currentCategoryNews',
            [
                'authorizedUserInfo' => Users::getAuthorizedUserInfo(),
                'category_id' => $category_id,
                'currentCategoryName' => News::getAllCategories()[$category_id]['name'], 'currentCategoryNews' => News::getCurrentCategoryNews($category_id)
            ]);
    }


    /**
     * Отображение одной новости по переданному идентификатору
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showNewsOne($id)
    {
        $news = News::getAllNews();

        if (array_key_exists($id, $news)) {
            $currentCategoryName = News::getNewsCategoryName($news[$id]['category_id']);

            return view('newsOne',
                ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categoryName' => $currentCategoryName, 'newsOne' => News::getAllNews()[$id]]);
        }

        return $this->showAllCategories();
    }
}
