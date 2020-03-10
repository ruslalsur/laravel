<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use App\Users;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * Отображение списка категорий новостей
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllCategories()
    {
        return view('news/categories', ['categories' => Category::all()]);
    }


    /**
     * Отображение новостей по категории
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews(Category $category)
    {
        return view('news/currentCategoryNews',
            [
                'category_id' => $category,
                'currentCategoryName' => $category->name,
                'currentCategoryNews' => $category->news()->paginate(13)
            ]);
    }


    /**
     * Отображение одной новости
     *
     *
     * @return \Illuminate\View\View
     */
    public function showNewsOne(News $news)
    {
        return view('news/newsOne', ['categoryName' => $news->category()->name, 'newsOne' => $news]);
    }


    /**
     * отдача новости в формате json по запросу пользователя
     *
     * @param News $news
     * @return JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function download(News $news)
    {
        $filename = 'news_' . $news->id . '_from_' . $news->event_date;

        return response()
            ->json($news)
            ->header('Content-Disposition', 'attachment; filename = "' . $filename . '.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
