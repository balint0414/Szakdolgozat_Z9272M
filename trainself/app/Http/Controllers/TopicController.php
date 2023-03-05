<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        $posts = $topic->posts()->orderBy('created_at', 'desc')->paginate(5);

        return view('topic.show')->with(compact('topic', 'posts'));
    }
}
