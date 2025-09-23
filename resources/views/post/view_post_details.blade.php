@extends('main_design')

@section('post.view_post_details')
<div class="container py-5">
    <h2 class="mb-4 text-success fw-bold text-center">{{ $post->title }}</h2>

    <div class="card shadow-sm p-0">
        @php
            $images = json_decode($post->images, true);
        @endphp

        <div class="row g-0 align-items-start">
            <!-- Left Side: Bigger Image -->
            <div class="col-md-7 p-0 d-flex justify-content-center align-items-center">
                @if(!empty($images))
                    <img src="{{ asset($images[0]) }}"
                         alt="Post Image"
                         class="img-fluid"
                         style="width:100%; height:500px; object-fit:cover;">
                @else
                    <img src="{{ asset('default.jpg') }}"
                         alt="No Image"
                         class="img-fluid"
                         style="width:100%; height:500px; object-fit:cover;">
                @endif
            </div>

            <!-- Right Side: Post Information -->
            <div class="col-md-5 p-4 text-start">
                <h3 class="fw-bold text-primary mb-3 text-uppercase">Information</h3>
                <p><strong>Occurrence Date:</strong> {{ \Carbon\Carbon::parse($post->occurrence_date)->format('d M, Y') }}</p>
                <p><strong>Type:</strong> {{ ucfirst($post->type) }}</p>
                <p><strong>Category:</strong> {{ $post->category->category_name ?? 'Uncategorized' }}</p>
                <p><strong>Description:</strong> {{ $post->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="mt-5">
        <h4 class="fw-bold text-secondary">Comments</h4>

        @if(session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif

        <!-- Comment Form (top-level) -->
        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                    @error('comment') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <button type="submit" class="btn btn-success">Submit Comment</button>
            </form>
        @else
            <p><small>Please <a href="{{ route('login') }}">log in</a> to post a comment.</small></p>
        @endauth

        <!-- Show top-level comments -->
        @if($post->comments && $post->comments->count())
            @foreach($post->comments as $comment)
                @include('comments.comment', ['comment' => $comment, 'level' => 0])
            @endforeach
        @else
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endif
    </div>

</div>
@endsection
