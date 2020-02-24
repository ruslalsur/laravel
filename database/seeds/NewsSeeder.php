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

        for($i=0;$i<10;$i++) {
            $data[] = [
                'category_id' => rand(1, 5),
                'title' => $faker->realText(rand(20, 50)),
                'date' => $faker->date('Y-m-d'),
                'description' => $faker->realText(rand(500, 1000)),
                'isPrivate' => (boolean) rand(0, 1),
            ];
        }

        return $data;
    }
}
