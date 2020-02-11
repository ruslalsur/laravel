<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * По переданному идентификатору ищет имя категории в массиве категорий новостей
     *
     * @param int $id
     * @return string
     */
    private function getCategoryNameById($id): string
    {
        $currentCategory = $this->categories[array_search($id, array_column($this->categories, 'id'))];

        return $currentCategory['name'];
    }




    /**
     * Выбирает одну новость из массива новостей по переданному идентификатору
     *
     * @param int $id
     * @return array
     */
    private function getNewsOneById($id): array
    {
        return $this->news[array_search($id, array_column($this->news, 'id'))];
    }




    /**
     * Отображение списка всех категорий
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllCategories()
    {
        return view('categories', ['title' => 'Категории', 'categories' => $this->categories]);
    }




    /**
     * Отображение новостей по переданной категории
     *
     * @param int $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCurrentCategoryNews($category_id)
    {
        $currentCatNews = [];

        foreach ($this->news as $newsOne) {
            if ($newsOne['category_id'] == $category_id) {
                array_push($currentCatNews, $newsOne);
            }
        }

        return view('news',
            [
                'title' => 'Новости', 'categoryName' => $this->getCategoryNameById($category_id),
                'currentCatNews' => $currentCatNews
            ]);
    }




    /**
     * Отображение одной новости по переданному идентификатору
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewsOne($id)
    {
        $currentNewsOne = $this->getNewsOneById($id);
        $currentCategoryName = $this->getCategoryNameById($currentNewsOne['category_id']);

        return view('newsOne',
            ['title' => 'Новость', 'categoryName' => $currentCategoryName, 'newsOne' => $currentNewsOne]);
    }
}
