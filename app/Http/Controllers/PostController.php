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
            'status'            => 'required|in:pending,approved,resolved',
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
            'geo_lat'          => $request->latitude,
            'geo_long'          => $request->longitude,
            'contact_number'    => $request->contact_number,
            'hide_private_info' => $request->hide_private_info,
            'images'            => json_encode($imagePaths),
            'type'              => $request->type,
            'status'            => $request->status,
            'category_id'       => $request->category_id,
        ]);

        return redirect()->back()->with('post_message', 'Post added successfully!');
    }

    public function viewPost()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.post.view_post', compact('posts'));
    }

    public function updatePost($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::whereNotNull('parent_id')->get();

        return view('admin.post.update_post', compact('post', 'categories'));
    }

    public function postUpdatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // ✅ Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hidden_proof' => 'nullable|string|max:255',
            'occurrence_time' => 'nullable',
            'occurrence_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'hide_private_info' => 'nullable|string|max:255',
            'type' => 'required|in:lost,found',
            'status' => 'required|in:pending,approved,resolved,rejected',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $post->title            = $request->title;
        $post->description      = $request->description;
        $post->hidden_proof     = $request->hidden_proof;
        $post->occurrence_time  = $request->occurrence_time;
        $post->occurrence_date  = $request->occurrence_date;
        $post->location         = $request->location;
        $post->geo_lat          = $request->latitude;
        $post->geo_long         = $request->longitude;
        $post->contact_number = $request->contact_number;
        $post->hide_private_info = $request->hide_private_info;
        $post->type = $request->type;
        $post->status = $request->status;
        $post->category_id = $request->category_id;

        if ($request->hasFile('images')) {
            if ($post->images) {
                $oldImages = json_decode($post->images, true);
                foreach ($oldImages as $oldImage) {
                    $oldPath = public_path($oldImage);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }

            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/posts'), $filename);
                $newImagePaths[] = 'uploads/posts/' . $filename;
            }
            $post->images = json_encode($newImagePaths);
        }

        $post->save();

        return redirect()->route('admin.post.view_post')->with('post_message', 'Post updated successfully!');
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->back()->with('post_message', 'Post is deleted!');
    }

    public function allPosts(Request $request)
    {
        $query = Post::with('category')->where('status', '=', 'approved')->orderBy('created_at', 'desc');
        $categories = Category::whereNotNull('parent_id')->get();

        if (isset($request->title) && ($request->title != null)) {
            $query->where('title', $request->title);
        }

        if (isset($request->category_id) && ($request->category_id != null)) {
            $query->where('category_id', $request->category_id);
        }
        if (isset($request->type) && ($request->type != null)) {
            $query->where('type', $request->type);
        }
        if (isset($request->occurrence_date) && ($request->occurrence_date != null)) {
            $query->where('occurrence_date', $request->occurrence_date);
        }
        $posts = $query->paginate(3);
        return view('post.all_posts', compact('posts', 'categories'));
    }


    public function postsDetails($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return view('post.view_post_details', compact('post'));
    }

    public function newPost()
    {
        $categories = Category::all();
        return view('post.new_post', compact('categories'));
    }

     public function postNewPost(Request $request)
    {
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
            'category_id'       => 'required|exists:categories,id',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            print_r($request->file('images'));
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/posts'), $filename);
                $imagePaths[] = 'uploads/posts/' . $filename;
            }
        }

        $occurrenceDateTime = $request->occurrence_date;
        if ($request->occurrence_time) {
            $occurrenceDateTime = date('Y-m-d H:i:s', strtotime($request->occurrence_date . ' ' . $request->occurrence_time));
        } else {
            $occurrenceDateTime = date('Y-m-d', strtotime($request->occurrence_date));
        }

        Post::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'hidden_proof'      => $request->hidden_proof,
            'occurrence_time'   => $request->occurrence_time,
            'occurrence_date'   => $request->occurrence_date,
            'location'          => $request->location,
            'geo_lat'          => $request->latitude,
            'geo_long'          => $request->longitude,
            'contact_number'    => $request->contact_number,
            'hide_private_info' => $request->hide_private_info,
            'images'            => json_encode($imagePaths),
            'type'              => $request->type,
            'category_id'       => $request->category_id,
        ]);

        return redirect()->back()->with('post_message', 'Post added successfully!');
    }

    public function funFacts()
    {
        $posts = Post::with('category')
                    ->where('status', 'approved')
                    ->latest()
                    ->take(6)
                    ->get();
        $foundCount = Post::where('type', 'found')->where('status', 'approved')->count();
        $lostCount = Post::where('type', 'lost')->where('status', 'approved')->count();
        $resolvedCount = Post::where('status', 'resolved')->count();

        return view('index', compact('posts', 'foundCount', 'lostCount', 'resolvedCount'));
    }


}
