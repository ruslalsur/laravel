<?php

namespace Tests\Browser;

use App\Category;
use App\News;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Throwable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsDuskTest extends DuskTestCase
{
    use RefreshDatabase;

    private $news;

    /**
     * первое тестирование формы для создания новости.
     *
     * @return void
     * @throws Throwable
     */
    public function testCreateNewsForm1()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('news.create'))
                ->type('title', 'заголовок так себе')
                ->type('description', 'Новости')
                ->press('Создать')
                ->assertSee('Содержимое дожно начинаться с заглавной буквы.⁠')
                ->assertSee('Количество символов в поле "Текст новости" должно быть между 10 и 5000.⁠')
                ->assertPathIs('/news/create');
        });
    }

    /**
     * второе тестирование формы для создания новости.
     *
     * @return void
     * @throws Throwable
     */
    public function testCreateNewsForm2()
    {
        $this->news = News::query()->find(rand(1, News::all()->count()));

        $this->browse(function (Browser $browser) {
            $browser->visit(route('news.create'))
                ->select('category_id', $this->news->category_id)
                ->type('title', 'Заголовок што надо себе')
                ->type('description', 'Новости утешительные и валидные')
                ->press('Создать')
                ->assertPathIs("/news/currentCategory/{$this->news->category_id}");
        });
    }

    /**
     * Тестирование формы для изменения новости.
     *
     * @return void
     * @throws Throwable
     */
    public function testEditNewsForm1()
    {
        $this->news = News::query()->find(rand(1, News::all()->count()));

        $this->browse(function (Browser $browser) {
            $browser->visit(route('news.edit', $this->news))
                ->type('title', 'заголовок так себе')
                ->type('description', 'Новости')
                ->press('Применить')
                ->assertSee('Содержимое дожно начинаться с заглавной буквы.⁠')
                ->assertSee('Количество символов в поле "Текст новости" должно быть между 10 и 5000.⁠')
                ->assertPathIs("/news/{$this->news->id}/edit");
        });
    }

    /**
     * Тестирование формы для изменения новости.
     *
     * @return void
     * @throws Throwable
     */
    public function testEditNewsForm2()
    {
        $this->news = News::query()->find(rand(1, News::all()->count()));

        $this->browse(function (Browser $browser) {
            $browser->visit(route('news.edit', $this->news))
                ->type('title', 'Заголовок што надо')
                ->type('description', 'Новости неутешительные, но валидные')
                ->press('Применить')
                ->assertPathIs("/news/newsOne{$this->news->id}");
        });
    }
}
