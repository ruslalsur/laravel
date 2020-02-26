<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
            ->assertViewHas($key = 'categories', \App\News::getCategories())
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
        $response->assertJsonFragment(["isPrivate" => 1])
            ->assertJsonMissing(['category_id' => 2]);
    }

    public function testHeaderData()
    {
        $response = $this->get(route('news.download', 1));
        $response->assertHeader('Content-Type', $value = 'application/json');
    }
}
