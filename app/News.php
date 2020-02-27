<?php

namespace App;

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
}
