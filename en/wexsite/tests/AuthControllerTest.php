<?php


//  ! ! I M P O R T A N T !! : in URLS NOT insert  "/en/"   prefix ! ! ! ! ! ! !    // example: visit('auth/login') ! ! 


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{


	use DatabaseTransactions;   // avoid INSERT NEW records in DB (ex: register form insert new 'email' into 'unique' DB field)



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
    		 ->seePageIs('/register');
    }

    public function testRegisterForm()
    {
    	$this->visit('register')
    		 ->type('test', 'name')
    		 ->type('test', 'surname')
    		 ->type('test@test1.test', 'email')
    		 ->type('testing', 'password')
    		 ->type('testing', 'password_confirmation')
    		 ->check('tos')
    		 ->check('tos')
    		 ->check('allow_personal_data')
    		 ->press('Register')    // !! CASE SENSITIVE !! 
    		 ->seePageIs('/user/dashboard')
    		 ->see('dashboard')
    		 ->assertResponseStatus('200');
    }

    public function testLoginForm() {
    	$this->visit('auth/login')
    		 ->type('test@test.test', 'email')
			 ->type('testing', 'password')
			 ->press('Sign In')
			 ->seePageIs('/user/dashboard')
			 ->see('dashboard')
			 ->assertResponseStatus('200');
    }
}
