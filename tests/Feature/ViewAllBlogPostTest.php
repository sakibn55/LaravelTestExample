<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewAllBlogPostTest extends TestCase
{
    use DatabaseMigrations;
    public function testCanViewAllBlogPosts(){
        $post1 = Post::create([
            'title' => 'A simple title 1',
            'body' => ' A simple body',
        ]);
        $post2 = Post::create([
            'title' => 'A simple title 2',
            'body' => ' A simple body',
        ]);

        $resp = $this->get('/posts');

        $resp->assertStatus(200);

        $resp->assertSee($post1->title);
        $resp->assertSee($post2->title);
        $resp->assertSee($post1->body);
        $resp->assertSee($post2->body);
    }
}
