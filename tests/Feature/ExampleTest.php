<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get(route('news.home'));

        $response->assertStatus(200);
    }

    public function testCategoriesView()
    {
        $response = $this->get(route('news.categories'));
        $response->assertViewIs('news.categories')
            ->assertViewHas($key = 'categories', Category::all())
            ->assertSee('новостей')
            ->assertDontSeeText('приватна');
    }

    public function testCategoriesCookie()
    {
        $response = $this->get(route('news.categories'));
        $response->assertCookie('XSRF-TOKEN');
    }

    public function testJsonDataFragment()
    {
        $response = $this->get(route('news.download', 1));
        $response->assertJsonFragment(['updated_at' => null])
            ->assertJsonMissing(['category_id' => 2]);
    }

    public function testHeaderData()
    {
        $response = $this->get(route('news.download', 1));
        $response->assertHeader('Content-Type', $value = 'application/json');
    }
}
