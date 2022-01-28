<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (){
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Page not found');
        }
        return view('post')->withPost($post);
    }
}
