<?php


namespace App\MyServices;


use App\Category;
use App\News;
use Illuminate\Http\RedirectResponse;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Storage;

class RssParserService
{
    /**
     * сохраниение новостей источника в базу данных
     *
     * @param $source string ссылка на источник новостей
     * @return RedirectResponse|void
     */
    public function storeNews($source)
    {
        try {
            $xml = XmlParser::load($source->url);
        } catch (\Exception $e) {
            return redirect()->route('news.categories')->with('failure', "Источник {$source->url} не найден");
        }

        //парсинг $xml в асоциативный массив $data
        $data = $xml->parse([
            'category' => $source->name,
            'image' => ['uses' => 'channel.image.url'],
            'news' => ['uses' => 'channel.item[title,description,link,pubDate]'],
        ]);

        //работа с категориями (создание новой или, если есть, в любом случае получаем id категории)
        $category_id = null;
        $category = new Category();
        $isExistCategory = $category->newQuery()->where('name', $data['category'])->first();

        if (isset($isExistCategory)) {
            $category_id = $isExistCategory->id;
        } else {
            $category->name = $data['category'];
            $category->image = $data['image'];
            $category->save();
            $category_id = $category->newQuery()->count();
        }

        //работа с новостями
        foreach ($data['news'] as $item) {
            if (!News::query()->where('title', $item['title'])->exists()) {
                $news = new News();

                if (!$news->newQuery()->where('title', '==', $item['title'])->exists()) {
                    $news->fill([
                        'category_id' => $category_id,
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'event_date' => date("Y-m-d", strtotime($item['pubDate'])),
                        'image' => $data['image'],
                        'is_private' => (boolean)rand(0, 1),
                        'news_source' => $item['link']
                    ]);

                    $news->save();
                }
            }

            //запись в лог-файл времени и url сохраненного источника
//            $file = 'rsslog_' . time() . '.log';
//            Storage::disk('rssLogs')->append($file, date('c') . $source->name);
        }
    }
}
