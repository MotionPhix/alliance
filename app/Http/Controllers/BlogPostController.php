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

}
