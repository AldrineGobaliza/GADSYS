<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;

class PublicController extends Controller
{
    public function home()
    {
        $posts = Post::where('status', 'published')
                     ->latest()
                     ->get();

        return view('public.home', compact('posts'));
    }

    public function showPost($id)
    {
        $post = Post::with('images')->findOrFail($id);

        return view('public.post', compact('post'));
    }

    public function events()
    {
        $events = Event::latest()->get();

        return view('public.events', compact('events'));
    }

    public function about()
    {
        return view('public.about');
    }
}