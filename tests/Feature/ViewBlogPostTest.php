<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBlogPostTest extends TestCase
{
    use RefreshDatabase;
    public function testCanViewABlogPost(){
        //arrangement
        //creating a blog post
        $post = Post::create([
            'title' => 'A simple title',
            'body' =>' A simple body',
        ]);

        //action
        //visiting a route
        $resp = $this->get('/post/'.$post->id);
        //assert
        //assert status code 200
        $resp->assertStatus(200);
        //assert that we see post title
        $resp->assertSee($post->title);
        //assert that we see post body
        $resp->assertSee($post->body);

        //assert that we see published date
        $resp->assertSee($post->createdAt());

    }

    public function testViewsA404PageWhenPageIsNotFound(){
        //action
        $resp = $this->get('post/INVALID_ID');
        //
        //assert
        $resp->assertStatus(404);
        $resp->assertSee("The page you are looking for couldnot be found");
    }
}
