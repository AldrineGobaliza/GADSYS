<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'event_date' => 'nullable|date',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120' 
        ]);

        // Save post
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'event_date' => $data['event_date'] ?? null,
        ]);

        // Save each uploaded image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                PostImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function index()
    {
        $posts = Post::latest()->get(); // get all posts, newest first
        return view('posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'event_date' => 'nullable|date',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120' 
        ]);

        if ($request->hasFile('staff_photo')) {
            // delete old staff_photo if exists
            if ($post->staff_photo) {
                Storage::disk('public')->delete($post->staff_photo);
            }
            $data['staff_photo'] = $request->file('staff_photo')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function publicTimeline()
    {
        $posts = Post::latest()->get(); // show newest posts first
        return view('posts.public', compact('posts'));
    }
}