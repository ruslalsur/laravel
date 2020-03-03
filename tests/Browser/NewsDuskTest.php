<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NewsDuskTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('news.create'))
                ->press('Создать')
                ->assertSee('"Заголовок" обязательно для заполнения.⁠');
        });
    }
}
