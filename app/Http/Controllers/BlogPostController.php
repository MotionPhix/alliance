<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
  public function index()
  {
    $posts = BlogPost::where('is_published', true)
      ->orderBy('published_at', 'desc')
      ->paginate(6);

    return view('blogs.index', compact('posts'));
  }

  public function show($slug)
  {
    $post = BlogPost::where('slug', $slug)->firstOrFail();
    return view('blogs.show', compact('post'));
  }
}
