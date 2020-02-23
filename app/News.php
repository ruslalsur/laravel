<?php


namespace App;

use File;

class News
{
    private const PATH = __DIR__ . "/../storage/app/";


    /**
     * запись данных  в глобальный массив, если там их еще нету,
     * вызывается в конструкторе базового контролера
     *
     */
    public static function init()
    {
        if (!session()->exists('categories')) {
            session()->put('categories', self::loadCatData());
        }

        if (!session()->exists('news')) {
            session()->put('news', self::loadNewsData());
        }
    }



    /**
     * геттер новостей из глобального массива
     *
     * @return array
     */
    public static function getAllNews()
    {
        if (session()->exists('news')) {
            return session()->get('news');
        }

        return null;
    }



    /**
     * геттер категорий из глобального массива
     *
     * @return array
     */
    public static function getAllCategories()
    {
        if (session()->exists('categories')) {
            return session()->get('categories');
        }

        return null;
    }



    /**
     * Возвращает подборку новостей по переданному Id категории
     *
     * @param int $categoryId
     * @return array
     */
    public static function getCurrentCategoryNews($categoryId)
    {
        $currentCategoryNews = [];
        if (array_key_exists($categoryId, self::getAllCategories())) {
            foreach (self::getAllNews() as $newsOne) {
                if ($newsOne['category_id'] == $categoryId) {
                    $currentCategoryNews[] = $newsOne;
                }
            }
        }
        return $currentCategoryNews;
    }



    /**
     * выяснение названия категории у новости по идентификатору новости
     *
     * @param $categoryId
     * @return string
     */
    public static function getNewsCategoryName($categoryId)
    {
        return self::getAllCategories()[$categoryId]['name'];
    }



    /**
     * сохранение изменений на диск
     */
    public static function saveData()
    {
        if (session()->exists('categories')) {
            $content = json_encode(self::getAllCategories(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            File::put(self::PATH . 'categories.json', $content);
        }

        if (session()->exists('news')) {
            $content = json_encode(self::getAllNews(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            File::put(self::PATH . 'news.json', $content);
        }
    }



    /**
     * загрузка данных из файла категорий
     */
    public static function loadCatData()
    {
        $content = File::get(self::PATH . 'categories.json');

        return json_decode($content, true);
    }



    /**
     * загрузка данных из файла новостей
     */
    public static function loadNewsData()
    {
        $content = File::get(self::PATH . 'news.json');

        return json_decode($content, true);
    }
}
