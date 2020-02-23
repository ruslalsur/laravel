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
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCategoriesView()
    {
        $response = $this->get(route('categories'));
        $response->assertViewIs('categories')
            ->assertViewHas($key = 'categories', $value = \App\News::getAllCategories())
            ->assertSee('Категории')
            ->assertDontSeeText('приватна');
    }

    public function testSession()
    {
        $response = $this->get(route('categories'));
        $response->assertSessionHas('categories', \App\News::getAllCategories())
            ->assertSessionHas('news')
            ->assertSessionHas('users');
    }

    public function testCategoriesCookie()
    {
        $response = $this->get(route('categories'));
        $response->assertCookie('XSRF-TOKEN');
    }

    public function testJsonDataFragment()
    {
        $response = $this->get(route('download', 0));
        $response->assertJsonFragment(["isPrivate" => true])
        ->assertJsonMissing(['category_id' => 2]);

        $response = $this->get(route('download', 1));
        $response->assertJsonFragment(["isPrivate" => false])
            ->assertJsonMissing(['category_id' => 2]);
    }

    public function testHeaderData()
    {
        $response = $this->get(route('download', 0));
        $response->assertHeader('Content-Type', $value = 'application/json');
    }



}
