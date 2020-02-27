<?php


namespace App;

use Illuminate\Support\Facades\DB;

class NewsBeforeLesson5
{
    /**
     * получение всех новостей из базы данных
     * @return array
     */
    public static function getNews()
    {
        return DB::table('news')->get()->toArray();
    }


    /**
     * получение всех категорий из базы данных
     * @return array
     */
    public static function getCategories()
    {
        return DB::table('categories')->get()->toArray();
    }


    /**
     * поиск конкретной новости в базе данных
     * @param $newsId
     * @return object
     */
    public static function getNewsOne($newsId)
    {
        return DB::table('news')->find($newsId);
    }


    /**
     * поиск конкретной категории в базе данных
     * @param $categoryId
     * @return object
     */
    public static function getCategory($categoryId)
    {
        return DB::table('categories')->find($categoryId);
    }


    /**
     * возвращает список новостей по переданному идентификатору категории
     *
     * @param int $categoryId
     * @return \Illuminate\Support\Collection
     */
    public static function getCurrentCategoryNews($categoryId)
    {
        return DB::table('news')->where('category_id', '=', $categoryId)->get();
    }


    /**
     * создание новой категории
     *
     * @param int $categoryName
     * @return boolean
     */
    public static function createCategory($categoryName)
    {
        if (isset($categoryName)) {
            $categoryContains = self::categoryContainsNews($categoryName);


            if (!isset($categoryContains)) {
                return DB::table('categories')->insert(['name' => $categoryName]);
            }
        }
        return false;
    }


    /**
     * удаление категории
     *
     * @param int $categoryName
     * @return boolean
     */
    public static function deleteCategory($categoryName)
    {
        $categoryContains = self::categoryContainsNews($categoryName);

        if (isset($categoryContains)) {
            $categoryId = $categoryContains['categoryId'];
            $howManyNewsContainsInCategory = $categoryContains['howManyNewsContainsInCategory'];

            if (!$howManyNewsContainsInCategory) {
                return DB::table('categories')->where('id', '=', $categoryId)->delete();
            }
        }

        return false;
    }

    /**
     * сервисный метод
     * принимая на входе имя категории, возвращает ee идентификатор количество содержащихся в ней или null
     *
     * @param int $categoryName
     * @return array| null
     */
    private static function categoryContainsNews($categoryName)
    {
        $categoryId = DB::table('categories')->where('name', '=', $categoryName)->first();

        if (isset($categoryId)) {
            $categoryId = $categoryId->id;
            $howManyNewsContainsInCategory = DB::table('news')->where('category_id', '=', $categoryId)->count();

            return ['categoryId' => $categoryId, 'howManyNewsContainsInCategory' => $howManyNewsContainsInCategory];
        }

        return null;
    }
}
