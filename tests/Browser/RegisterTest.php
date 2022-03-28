<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use withFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGoToRegisterPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->assertSee(__('Register'))
                ->assertSee(__('Login now'))
                ->assertPresent('input[name="email"]')
                ->assertPresent('input[name="password"]')
                ->assertPresent('input[name="password_confirmation"]')
                ->assertPresent('input[name="first_name"]')
                ->assertPresent('input[name="last_name"]')
                ->assertPresent('button.register-btn');
        });
    }

    public function testGoToLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->click(".login-btn")
                ->visitRoute('login')
                ->assertPathIs('/login');
        });
    }

    public function testGoToHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->click(".auth-logo")
                ->visitRoute('home')
                ->assertPathIs('/');
        });
    }

    // Test required input
    public function testRegisterFailRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->click("button.register-btn")
                ->assertSee(__('validation.required', ['attribute' => 'email']))
                ->assertSee(__('validation.required', ['attribute' => 'first name']))
                ->assertSee(__('validation.required', ['attribute' => 'last name']))
                ->assertSee(__('validation.required', ['attribute' => 'password']))
                ->assertPathIs('/register');
        });
    }

    // Test Exited email
    public function testRegisterFailExistEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->type('email', 'admin@gmail.com')
                ->type("first_name", $this->faker->firstName)
                ->type("last_name", $this->faker->lastName)
                ->type('password', '123456')
                ->type('password_confirmation', '123456')
                ->click("button.register-btn")
                ->assertSee(__('validation.unique', ['attribute' => 'email']))
                ->assertPathIs('/register');
        });
    }

    // Test Password and Password Confirmation not match
    public function testRegisterFailPasswordNotMatch()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->type('email', 'admin@gmail.com')
                ->type("first_name", $this->faker->firstName)
                ->type("last_name", $this->faker->lastName)
                ->type('password', '123456')
                ->type('password_confirmation', '654321')
                ->click("button.register-btn")
                ->assertSee(__('validation.same', [
                    'attribute' => 'password confirmation',
                    'other' => 'password',
                ]))
                ->assertPathIs('/register');
        });
    }

    // Register Success
    public function testRegisterFeature()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->type("first_name", $this->faker->firstName)
                ->type("last_name", $this->faker->lastName)
                ->type("email", $this->faker->email)
                ->type("password", '123456')
                ->type("password_confirmation", '123456')
                ->click("button.register-btn");

            $browser->assertPathIs('/email/verify');
        });
    }
}
