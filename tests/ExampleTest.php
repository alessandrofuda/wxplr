<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample() {
        $this->visit('/')
             ->see('home')  // in Html
             ->dontSee('exception');

    }

    public function testClickTryItNow() {

        $this->visit('/')
             //->click('TRY IT NOW!') // body 
             ->click('try-it')  // id
             ->seePageIs('register');

    }
}
