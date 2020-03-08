<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\RedirectResponse;
use Orchestra\Parser\Xml\Facade as XmlParser;

class NewsParserController extends Controller
{
    /**
     * регистрация источников для обработки
     * просто добавте ссылку на источник
     *
     * @return array
     */
    private function getNewsSource()
    {
        return [
            'https://news.yandex.ru/army.rss',
            'https://news.yandex.ru/auto.rss',

        ];
    }


    /**
     * обработка ранее зарегистрированных источников по одному
     * @return RedirectResponse
     */
    public function index()
    {
        foreach ($this->getNewsSource() as $source) {
            $this->storeNews($source);
        }
        return redirect()->route('news.categories');
    }


    /**
     * сохраниение новостей источника в базу данных
     *
     * @param $source ссылка на источник новостей
     * @return RedirectResponse|void
     */
    private function storeNews($source)
    {
        try {
            $xml = XmlParser::load($source);
        } catch (\Exception $e) {
            return redirect()->route('news.categories')->with('failure', "Источник {$source} не найден");
        }

        //парсинг мешанины в асоциативный массив
        $xml = $xml->parse([
            'category' => ['uses' => 'channel.title'],
            'image' => ['uses' => 'channel.image.url'],
            'news' => ['uses' => 'channel.item[title,description,link,pubDate]'],
        ]);

        //работа с категориями (создание новой, если нет, в любом случае получаем id категории)
        $category_id = null;
        $category = new Category();
        $isExistCategory = $category->newQuery()->where('name', $xml['category'])->first();

        if (isset($isExistCategory)) {
            $category_id = $isExistCategory->id;
        } else {
            $category->name = $xml['category'];
            $category->image = $xml['image'];
            $category->save();
            $category_id = $category->newQuery()->count();
        }

        //работа с новостями
        foreach ($xml['news'] as $item) {
            $news = new News();
            $news->fill([
                'category_id' => $category_id,
                'title' => $item['title'],
                'description' => $item['description'],
                'event_date' => date("Y-m-d", strtotime($item['pubDate'])),
                'image' => $xml['image'],
                'is_private' => 0,
                'news_source' => $item['link']
            ]);
            $news->save();
        }
    }
}
