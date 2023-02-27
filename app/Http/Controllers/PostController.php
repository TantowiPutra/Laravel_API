<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);

        // Penulisan PostResource::collection digunakan ketika data yang dikembalikan > 1
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post = Post::with('writer:id,username')->findOrFail($post->id);

        // Format dibawha digunakan untuk mengembalikan Single API Resource
        return new PostDetailResource($post);
    }

    public function show2(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return new PostDetailResource($post);
    }
}
