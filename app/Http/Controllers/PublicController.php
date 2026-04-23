<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Personnel;

class PublicController extends Controller
{
    public function home()
    {
        $posts = Post::where('status', 'published')
                     ->latest()
                     ->get();

        $events = Event::orderBy('event_date', 'asc')
                ->take(5)
                ->get();       

        return view('public.home', compact('posts', 'events'));
    }

    public function showPost($id)
    {
        $post = Post::with('images')->findOrFail($id);

        return view('public.posts', compact('post'));
    }

    public function events()
    {
        $events = Event::orderBy('event_date', 'asc')->get();

        return view('public.events', compact('events'));
    }

    public function about()
    {
        $personnel = Personnel::latest()->get();

        return view('public.about', compact('personnel'));
    }
}