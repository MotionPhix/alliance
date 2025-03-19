<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class LikeController extends Controller
{
  public static function middleware(): array
  {
    return [
      new Middleware(middleware: 'auth:sanctum', except: ['index', 'show']),
    ];
  }

  public function toggle(Request $request, BlogPost $post)
  {
    $post->toggleLike(auth()->user());

    return response()->json([
      'liked' => $post->isLikedBy(auth()->user()),
      'count' => $post->likes()->count(),
    ]);
  }
}
