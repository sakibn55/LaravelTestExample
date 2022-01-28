<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePostTest extends DuskTestCase
{
    use RefreshDatabase;
    public function testAuthUserCanCreatePost(){
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use($user){
            $browser->loginAs($user)
            ->visit('/create-post')
            ->type('title', 'new post 2')
            ->type('body' ,'new body')
            ->press('Save Post')
            ->assertPathIs('/posts')
            ->assertSee('new body');
        });
    }

    public function testonlyAuthUserCanCreatePost()
    {

        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/create-post')
                ->assertPathIs('/login');
        });
    }
}
