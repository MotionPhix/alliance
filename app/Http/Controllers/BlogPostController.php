<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogPostController extends Controller
{
  public function index(Request $request)
  {
    $query = BlogPost::published()
      ->with(['user', 'tags', 'media'])
      ->orderBy('published_at', 'desc');

    if ($request->has('search')) {
      $search = $request->input('search');
      $query->where(function($q) use ($search) {
        $q->where('title', 'like', "%{$search}%")
          ->orWhere('excerpt', 'like', "%{$search}%")
          ->orWhere('content', 'like', "%{$search}%");
      });
    }

    if ($request->has('tag')) {
      $query->withAnyTags([$request->input('tag')]);
    }

    $posts = $query->paginate(8)->withQueryString();

    return view('pages.blogs.index', compact('posts'));
  }

  public function show($slug)
  {
    $post = Cache::remember("blog_post.{$slug}", 3600, function () use ($slug) {
      return BlogPost::where('slug', $slug)
        ->with(['user', 'tags', 'comments.user', 'media'])
        ->firstOrFail();
    });

    // Increment view count
    if (!session()->has("viewed_post_{$post->id}")) {
      $post->incrementViewCount();
      session()->put("viewed_post_{$post->id}", true);
    }

    $relatedPosts = BlogPost::published()
      ->where('id', '!=', $post->id)
      ->withAnyTags($post->tags->pluck('name')->toArray())
      ->limit(3)
      ->get();

    return view('pages.blogs.show', compact('post', 'relatedPosts'));
  }
}
