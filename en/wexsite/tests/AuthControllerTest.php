<?php


//  ! ! I M P O R T A N T !! : in URLS NOT insert  "/en/"   prefix ! ! ! ! ! ! !    // example: visit('auth/login') ! ! 


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        //$this->assertTrue(true);
        $this->visit('auth/login')
        	 ->see('login')  
        	 ->assertResponseOk();
    }

    public function testLoginPageRegisterLink()
    {
    	$this->visit('auth/login')
    		 ->click('Register a new membership')
    		 ->seePageIs('register');
    }

    public function testLoginForm() {
    	//$this->visit('auth/login')
    		 //->type('XXXXXXXXXXX@gmail.com', 'email')
			 //->type('', '')
    }
}
