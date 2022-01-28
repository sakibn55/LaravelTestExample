<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;

    public function testUserCanLogin()
    {

        $this->browse(function ($browser) {
            $browser->loginAs(1)
            ->visit('/user/profile')
            ->waitForText('Nazmus Sakib');
        });
    }


}
