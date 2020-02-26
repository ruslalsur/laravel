<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;
use App\Users;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * Отображение списка всех категорий
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllCategories()
    {
        return view('news/categories', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => News::getCategories()]);
    }


    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        return view('news/currentCategoryNews',
            [
                'authorizedUserInfo' => Users::getAuthorizedUserInfo(),
                'category_id' => $category_id,
                'currentCategoryName' => News::getCategory($category_id)->name, 'currentCategoryNews' => News::getCurrentCategoryNews($category_id)
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
        $newsOne = News::getNewsOne($id);
        $currentCategoryName = News::getCategory($newsOne->category_id)->name;

        return view('news/newsOne', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(),
            'categoryName' => $currentCategoryName, 'newsOne' => $newsOne]);
    }


    /**
     * отдача новости в формате json по запросу пользователя
     *
     * @param $newsId
     * @return JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function download($newsId)
    {
        $userQueryNews = News::getNewsOne($newsId);
        $filename = 'news_' . $userQueryNews->id . '_from_' . $userQueryNews->date;

        return response()
            ->json($userQueryNews)
            ->header('Content-Disposition', 'attachment; filename = "' . $filename . '.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
