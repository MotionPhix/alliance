<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
  public function store(BlogPost $post)
  {
    $post->likes()->create([
      'user_id' => auth()->id(),
    ]);

    return redirect()->back()->with('success', 'Post liked successfully!');
  }

  public function destroy(Like $like)
  {
    $like->delete();
    return redirect()->back()->with('success', 'Post unliked successfully!');
  }
}
