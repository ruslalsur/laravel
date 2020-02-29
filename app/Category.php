<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель категорий новостей
 *
 * @package App
 * @property string name
 */

class Category extends Model
{
    protected $fillable = ['name'];

    public function news() {
        return $this->hasMany(News::class, 'category_id');
    }
}
