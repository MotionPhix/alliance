<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, BlogPost $post)
  {
    $request->validate([
      'content' => 'required|string|max:1000',
    ]);

    $comment = $post->comments()->create([
      'user_id' => auth()->id(),
      'content' => $request->input('content'),
    ]);

    if ($request->ajax()) {
      return response()->json([
        'success' => true,
        'comment' => $comment,
        'message' => 'Comment added successfully!',
      ]);
    }

    return redirect()->back()->with('success', 'Comment added successfully!');
  }

  public function destroy(Comment $comment)
  {
    $comment->delete();

    if (request()->ajax()) {
      return response()->json([
        'success' => true,
        'message' => 'Comment deleted successfully!',
      ]);
    }

    return redirect()->back()->with('success', 'Comment deleted successfully!');
  }
}
