<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

   public function testCanGetCreatedAtFormattedDate(){
        //arrange
        //create a post
        $post = Post::create([
            'title' => 'A simple title',
            'body' => ' A simple body',
        ]);
       //act
       //get the value

       $formattedDate = $post->createdAt();
       //assert

       $this->assertEquals(
           $post->created_at->toFormattedDateString(), $formattedDate
       );
   }
}
