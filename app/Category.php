<?php

namespace App;

use App\Rules\CategoryIsEmpty;
use App\Rules\UpCaseStart;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель категорий новостей
 *
 * @package App
 * @property string name
 * @property string image
 */

class Category extends Model
{
    protected $fillable = ['name', 'image'];

    public function news() {
        return $this->hasMany(News::class, 'category_id');
    }

    /**
     * Правила валидации
     *
     * @return array
     */
    public static function rules() {
        $table = (new Category())->getTable();

        return [
            'name' => ['required', 'between:3,100', "unique:{$table}", new UpCaseStart()],
            'image' => 'mimes:jpg,jpeg,bmp,png,tga|max:256',
        ];
    }
    public static function rulesForDelete() {

        return [
            'name' => ['required' ,new CategoryIsEmpty()]
        ];
    }

    /**
     * Кастомизация наименований валидируемых полей при выводе сообщений об ошибках
     *
     * @return array
     */
    public static function attributeNames() {
        return [
            'name' => '"Название категории"',
            'image' => '"Изображение категории"',
        ];
    }
}
