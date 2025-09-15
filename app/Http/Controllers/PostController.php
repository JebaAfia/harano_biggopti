<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function addPost(){
        $categories = Category::all();
        return view('admin.post.add_post', compact('categories'));
    }
    public function postAddPost(Request $request)
    {
        // ✅ Validate inputs
        $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'hidden_proof'      => 'nullable|string|max:255',
            'occurrence_time'   => 'nullable|date_format:H:i',
            'occurrence_date'   => 'required|date_format:Y-m-d',
            'location'          => 'required|string|max:255',
            'contact_number'    => 'required|string|max:20',
            'hide_private_info' => 'nullable|string|max:255',
            'images.*'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'type'              => 'required|in:lost,found',
            'status'            => 'required|in:pending,approved',
            'category_id'       => 'required|exists:categories,id',
        ]);

        // ✅ Handle multiple images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            print_r($request->file('images'));
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/posts'), $filename);
                $imagePaths[] = 'uploads/posts/' . $filename;
            }
        }

        // ✅ Convert occurrence date & time safely using strtotime
        $occurrenceDateTime = $request->occurrence_date;
        if ($request->occurrence_time) {
            $occurrenceDateTime = date('Y-m-d H:i:s', strtotime($request->occurrence_date . ' ' . $request->occurrence_time));
        } else {
            $occurrenceDateTime = date('Y-m-d', strtotime($request->occurrence_date));
        }

        // ✅ Create post using mass assignment
        Post::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'hidden_proof'      => $request->hidden_proof,
            'occurrence_time'   => $request->occurrence_time,
            'occurrence_date'   => $request->occurrence_date,
            'location'          => $request->location,
            'contact_number'    => $request->contact_number,
            'hide_private_info' => $request->hide_private_info,
            'images'            => json_encode($imagePaths),
            'type'              => $request->type,
            'status'            => $request->status,
            'category_id'       => $request->category_id,
        ]);

        return redirect()->back()->with('post_message', 'Post added successfully!');
    }

}
