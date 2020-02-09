<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private function getCategoryNameById($id)
    {
        $currentCategory = $this->categories[array_search($id, array_column($this->categories, 'id'))];

        return $currentCategory['name'];
    }

    private function getNewsOneById($id)
    {
        return $this->news[array_search($id, array_column($this->news, 'id'))];
    }

    public function getAllCategories()
    {
        return view('categories', ['title' => 'Категории', 'categories' => $this->categories]);
    }

    public function getCurrentCategoryNews($id)
    {
        $currentCatNews = [];

        foreach ($this->news as $newsOne) {
            if ($newsOne['category_id'] == $id) {
                array_push($currentCatNews, $newsOne);
            }
        }

        return view('news',
            [
                'title' => 'Новости', 'categoryName' => $this->getCategoryNameById($id),
                'currentCatNews' => $currentCatNews
            ]);
    }

    public function getNewsOne($id)
    {
        $currentNewsOne = $this->getNewsOneById($id);
        $currentCategoryName = $this->getCategoryNameById($currentNewsOne['category_id']);

        return view('newsOne',
            ['title' => 'Новость', 'categoryName' => $currentCategoryName, 'newsOne' => $currentNewsOne]);
    }

    public function addNews()
    {
        return view('admin/add_news',
            ['title' => 'Добавить новость']);
    }
}
