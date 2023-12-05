<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with([
            'user','liked'
        ])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description'  => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create post and save it to database
        $post = Post::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => Auth::user()->id,
        ]);
            if ($post){
                return redirect('/posts')->with('message', 'Post Created Successfully');
            }   else{
                return back()->withErrors("error","Something went wrong!");
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('posts.index')->with('message', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post Deleted Successfully');
    }
}
