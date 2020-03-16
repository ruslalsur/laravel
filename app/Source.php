<?php

namespace App;

use App\Rules\UpCaseStart;
use Illuminate\Database\Eloquent\Model;


/**
 * Модель источников новостей
 *
 * @package App
 * @property string name
 * @property string url
 */
class Source extends Model
{
    protected $fillable = ['name', 'url'];

    /**
     * Правила валидации
     *
     * @return array
     */
    public static function rules() {

        return [
            'name' => ['required', "unique:sources,name",'string', 'between:3,100', new UpCaseStart()],
            'url' => 'required|unique:sources,url|url',
        ];
    }

    /**
     * Кастомизация наименований валидируемых полей при выводе сообщений об ошибках
     *
     * @return array
     */
    public static function attributeNames() {
        return [
            'name' => '"Низвание источника"',
            'url' => '"Адрес источника"',
        ];
    }
}
