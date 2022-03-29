<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    const ADMIN_ROLE = 1;
    const EMAIL = 'admin@gmail.com';
    const WRONG_EMAIL = 'admingmail.com';
    const PASSWORD = '123456';
    const WRONG_PASSWORD = 'loremispumdolor';
    const INVALID_PASSWORD = '123';

    public function testUserInterface()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->assertSee(__('To continue, log in to MyMusic.'))
                ->assertSee(__('Email address'))
                ->assertInputPresent('email')
                ->assertSee(__('Password'))
                ->assertInputPresent('password')
                ->assertSee(__('Forget Your Password?'))
                ->assertAttribute('a.forget-password', 'href', route('password.request'))
                ->assertSee(__('Remember me?'))
                ->assertInputPresent('remember')
                ->assertSeeIn('button[type="submit"]', __('Login'))
                ->assertSee(__('Don\'t have an account?'))
                ->assertSeeIn('.btn-register', __('SIGN UP FOR MYMUSIC'));
        });
    }

    public function testClickHome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->clickAndWaitForReload('.auth-header a')
                ->assertRouteIs('home');
        });
    }

    public function testClickForgotPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->click('div .forget-password')
                ->waitForLocation(route('password.request'))
                ->assertRouteIs('password.request');
        });
    }

    public function testClickSignUp()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->click('div .btn-register')
                ->waitForLocation(route('register'))
                ->assertRouteIs('register');
        });
    }

    public function testRequiredValidate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->type('email', '')
                ->type('password', '')
                ->clickAndWaitForReload('button[type="submit"]')
                ->assertRouteIs('login')
                ->assertSee(__('validation.required', ['attribute' => 'email']))
                ->assertSee(__('validation.required', ['attribute' => 'password']));
        });
    }

    public function testEmailValidate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->type('email', static::WRONG_EMAIL)
                ->type('password', static::WRONG_PASSWORD)
                ->clickAndWaitForReload('button[type="submit"]')
                ->assertRouteIs('login')
                ->assertSee(__('validation.email', ['attribute' => 'email']));
        });
    }

    public function testPasswordValidate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->type('email', static::WRONG_EMAIL)
                ->type('password', static::INVALID_PASSWORD)
                ->clickAndWaitForReload('button[type="submit"]')
                ->assertRouteIs('login')
                ->assertSee(__('validation.min.string', [
                    'attribute' => 'password',
                    'min' => 6,
                ]));
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->type('email', static::EMAIL)
                ->type('password', static::WRONG_PASSWORD)
                ->clickAndWaitForReload('button[type="submit"]')
                ->assertRouteIs('login')
                ->assertSee(__('auth.failed'));
        });
    }

    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->type('email', static::EMAIL)
                ->type('password', static::PASSWORD)
                ->click('label[for="remember-me"]')
                ->clickAndWaitForReload('button[type="submit"]')
                ->assertRouteIs('home');
        });
    }
}
