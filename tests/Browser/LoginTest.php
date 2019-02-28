<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class Login extends DuskTestCase
{
    /**
    *@test
     */
    public function user_can_login()
    {
        $user = User::first();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/manage');
        });
    }

    /**
    *@test
     */
    public function user_with_wrong_credential_will_fail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('email', 'test@test.com')
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/login');
        });
    }
}
