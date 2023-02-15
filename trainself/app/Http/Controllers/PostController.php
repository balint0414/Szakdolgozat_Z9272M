<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::orderBy('title')->get();
        return view('post.create')->with(['topics' => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $user = User::first();

        $post = $user->posts()->create($request->except('_token'));

        $image = $this->uploadImage($request);

        if($image){
            $post->cover = $image->basename;
            $post->save();
        }

        return redirect()->route('post.details', $post)->with('success', __('Sikeres volt a poszt feltöltése!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    private function uploadImage(Request $request)
    {
        $file = $request->file('cover');

        $fileName = uniqid();

        $cover = Image::make($file)->save(public_path("upload/posts/{$fileName}.{$file->extension()}"));

        return $cover;
    }
}
