<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData()
    {
        $data = [];
        $faker = Faker\Factory::create('ru_RU');

        for($i=0;$i<100;$i++) {
            $data[] = [
                'category_id' => rand(1, 5),
                'title' => $faker->realText(rand(40, 60)),
                'created_at' => $faker->date('Y-m-d'),
                'description' => $faker->realText(rand(1000, 2500)),
                'image' => rand(0, 1) ? 'img/news.jpg' : null,
                'isPrivate' => (boolean)rand(0, 1)
            ];
        }

        return $data;
    }
}
