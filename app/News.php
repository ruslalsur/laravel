<?php

namespace App;

use App\Rules\UpCaseStart;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель новостей
 *
 * @package App
 * @property string title
 * @property string description
 * @property boolean is_private
 * @property string image
 * @property string event_date
 * @property string category_id
 */

class News extends Model
{
    protected $fillable = ['title', 'description', 'is_private', 'image', 'event_date', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->first();
    }

    public static function rules() {
        $table = (new Category())->getTable();

        return [
            'title' => ['required', 'string', 'between:5,100', new UpCaseStart()],
            'description' => ['required', 'between:10,5000', new UpCaseStart()],
            'category_id' => "required|exists:{$table},id",
            'image' => 'mimes:jpg,jpeg,bmp,png,tga|max:1024',
            'is_private' => 'sometimes|in:on'
        ];
    }

    public static function attributeNames() {
        return [
            'title' => '"Заголовок"',
            'description' => '"Текст новости"',
            'category_id' => '"Категория"',
            'image' => '"Изображение"',
            'is_private' => '"Приватность"'
        ];
    }
}
