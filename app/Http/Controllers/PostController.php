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

    public function create(){
        return view('create-post');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'body' => 'required',
        ]);
        $post = Post::create([
            'title' =>$request->title,
            'body' =>$request->body,
        ]);

        return redirect('/posts');
    }
}
