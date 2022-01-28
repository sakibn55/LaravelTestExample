<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePost extends TestCase
{
    use DatabaseMigrations;
    public function testCanCreatePost(){
        $resp = $this->post('/store-post',[
            'title' => 'new post title',
            'body' =>'new post body',
        ]);
        $this->assertDatabaseHas('posts',[
            'title' => 'new post title',
            'body' => 'new post body',
        ]);

        $post = Post::find(1);
        $this->assertEquals('new post title', $post->title);
        $this->assertEquals('new post body', $post->body);
    }

    public function testTitleRequireToCreatePost(){
        $resp = $this->post('/store-post', [
            'title' => null,
            'body' => 'new post body',
        ]);

        $resp->assertSessionHasErrors('title');
    }

    public function testBodyRequireToCreatePost()
    {
        $resp = $this->post('/store-post', [
            'title' => "new post title",
            'body' => null,
        ]);

        $resp->assertSessionHasErrors('body');
    }
}
