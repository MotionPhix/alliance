<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request, BlogPost $post)
  {
    if ($post->isLikedBy($request->user())) {
      return response()->json(['message' => 'Already liked'], 409);
    }

    $post->likes()->create([
      'user_id' => $request->user()->id
    ]);

    return response()->json([
      'likes_count' => $post->likes()->count(),
      'message' => 'Post liked successfully'
    ]);
  }

  public function destroy(BlogPost $post)
  {
    $post->likes()->where('user_id', auth()->id())->delete();

    return response()->json([
      'likes_count' => $post->likes()->count(),
      'message' => 'Post unliked successfully'
    ]);
  }
}
