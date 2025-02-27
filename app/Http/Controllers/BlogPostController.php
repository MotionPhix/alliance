<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
  public function index(Request $request)
  {
    $query = BlogPost::where('is_published', true)
      ->orderBy('published_at', 'desc');

    if ($request->has('search')) {
      $query->where('title', 'like', '%' . $request->input('search') . '%')
        ->orWhere('excerpt', 'like', '%' . $request->input('search') . '%');
    }

    $posts = $query->paginate(6);

    return view('pages.blogs.index', compact('posts'));
  }

  public function show($slug)
  {
    $post = BlogPost::where('slug', $slug)->firstOrFail();
    $comments = $post->comments()->paginate(10);

    return view('pages.blogs.show', compact('post', 'comments'));
  }
}
