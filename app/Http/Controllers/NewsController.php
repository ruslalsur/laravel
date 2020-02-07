<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $categories = [
        [
            'id' => 1,
            'name' => 'Обучение'
        ],
        [
            'id' => 2,
            'name' => 'Здоровье'
        ],
    ];

    private $news = [
        [
            'id' => 1,
            'category_id' => 1,
            'title' => 'Задание к уроку номер один',
            'description' => '<p>1. Настроить на локальной машине окружение для работы с фреймворком.<br>2. Ознакомиться с документацией<br>3. Установить Laravel.<br>4. Реализовать несколько страниц с выводом какой-либо информации.</p>'
        ],
        [
            'id' => 2,
            'category_id' => 1,
            'title' => 'Задание к уроку номер два',
            'description' => '<p>1. Добавить в проект несколько контроллеров. Создать минимум 4 страницы. К примеру:<br><br>a. Страницу приветствия.<br>b. Страницу категорий новостей.<br>c. Страницу вывода новостей по конкретной категории.<br>d. Страницу вывода конкретной новости.<br>e *. Страницу авторизации.<br>f *. Страницу добавления новости.<br><br>2 *. Выбрать и сверстать дизайн для станиц приложения. Он не должен быть сложным, но обязательно должен содержать в себе 4 блока: блок шапки сайта, подвала, место вывода контента и область меню.</p>'
        ],
        [
            'id' => 3,
            'category_id' => 2,
            'title' => 'Здровье не купишь',
            'description' => 'Если хочешь быть здоров - ешь побольше докоторов ...'
        ],
        [
            'id' => 4,
            'category_id' => 2,
            'title' => 'Здорово, когда здоров!',
            'description' => 'Кто не курит и не пьёт - тот здоровеньким помрет ...'
        ],
    ];

    private function getCategoryNameById($id)
    {
        $currentCategory = $this->categories[array_search($id, array_column($this->categories, 'id'))];

//                dump($id);
//        dump($currentCategory);

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
            if($newsOne['category_id'] == $id) {
                array_push($currentCatNews, $newsOne);
            }
        }

        return view('news',
            ['title' => 'Новости', 'category' => $this->getCategoryNameById($id), 'currentCatNews' => $currentCatNews]);
    }

    public function getNewsOne($id)
    {
        $currentNewsOne = $this->getNewsOneById($id);
        $currentCategoryName = $this->getCategoryNameById($currentNewsOne['category_id']);

        return view('newsOne', ['title' => 'Новость', 'category' => $currentCategoryName, 'newsOne' => $currentNewsOne]);
    }
}
