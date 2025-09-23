<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id'   => 'required|exists:posts,id',
            'comment'   => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $data['user_id'] = Auth::id();

        Comment::create($data);

        return back()->with('success', 'Your comment has been posted.');
    }

    public function show($id)
    {
        $post = Post::with([
            'category',
            'comments.user',
            'comments.replies.user',
        ])->findOrFail($id);

        return view('post.view_post_details', compact('post'));
    }

}
