<?php

use App\Source;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sourses = [
            [
                'name' => 'Aвто',
                'url' => 'https://news.yandex.ru/auto.rss',
            ],
            [
                'name' => 'Армия',
                'url' => 'https://news.yandex.ru/army.rss',
            ],
            [
                'name' => 'Здоровье',
                'url' => 'https://news.yandex.ru/health.rss',
            ],
            [
                'name' => 'Религия',
                'url' => 'https://news.yandex.ru/religion.rss',
            ],
            [
                'name' => 'Политика',
                'url' => 'https://news.yandex.ru/politics.rss',
            ],
            [
                'name' => 'Экономика',
                'url' => 'https://news.yandex.ru/business.rss',
            ],
            [
                'name' => 'Спорт',
                'url' => 'https://news.yandex.ru/sport.rss',
            ],
            [
                'name' => 'Интернет',
                'url' => 'https://news.yandex.ru/internet.rss',
            ],
        ];

        DB::table('sources')->insert($sourses);
    }
}
