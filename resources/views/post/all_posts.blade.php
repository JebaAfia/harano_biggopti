@extends('main_design')

@section('post.all_posts')
<div class="container py-5">
    <h2 class="mb-4 text-success fw-bold text-center">All Posts</h2>

    <!-- 🔹 Second Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded shadow-sm">
        <div class="container-fluid justify-content-center">

            <span class="navbar-text me-4 fw-bold text-success">
                Search By
            </span>

            <!-- Category Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-outline-success dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    @foreach($categories as $category)
                        @if($category->parent_id !== null)
                            <li><a class="dropdown-item" href="{{ route('posts.filter_category', $category->id) }}">{{ $category->category_name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Type Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-outline-success dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Type
                </button>
                <ul class="dropdown-menu" aria-labelledby="typeDropdown">
                    <li><a class="dropdown-item" href="{{ route('posts.filter_type', 'lost') }}">Lost</a></li>
                    <li><a class="dropdown-item" href="{{ route('posts.filter_type', 'found') }}">Found</a></li>
                </ul>
            </div>

            <!-- Date Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-success dropdown-toggle" type="button" id="dateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Date
                </button>
                <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                    <li><a class="dropdown-item" href="{{ route('posts.filter_date_order', 'newest') }}">Newest on Top</a></li>
                    <li><a class="dropdown-item" href="{{ route('posts.filter_date_order', 'oldest') }}">Oldest on Top</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 🔹 End Second Navigation Bar -->

    <div class="row justify-content-center">
        @forelse($posts as $post)
            @php
                $images = json_decode($post->images, true);
                $firstImage = $images[0] ?? null;
            @endphp

            <div class="col-md-8 mb-3"> {{-- Smaller row width --}}
                <div class="d-flex border shadow-sm">
                    <!-- Image -->
                    <div class="flex-shrink-0" style="width: 200px; height: 150px; overflow: hidden;">
                        @if($firstImage)
                            <img src="{{ asset($firstImage) }}" alt="{{ $post->title }}" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <img src="{{ asset('default.jpg') }}" alt="No Image" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                        @endif
                    </div>

                    <!-- Information -->
                    <div class="flex-grow-1 p-3 d-flex flex-column justify-content-center">
                        <h5 class="mb-2">{{ $post->title }}</h5>
                        <p class="mb-1"><strong>Date:</strong> {{ $post->occurrence_date }}</p>
                        <p class="mb-1"><strong>Type:</strong> {{ $post->type }}</p>
                        <p class="mb-0"><strong>Category:</strong> {{ $post->category->category_name ?? 'Uncategorized' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No posts found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
