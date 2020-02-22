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
}
