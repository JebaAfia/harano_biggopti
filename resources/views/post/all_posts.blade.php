@extends('main_design')

@section('post.all_posts')
<div class="container py-5">
    <h2 class="mb-4 text-success fw-bold text-center">All Posts</h2>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-success text-white fw-bold">
                    Search & Filters
                </div>
                <div class="card-body">
                    <form action="{{ route('post.all_posts') }}" method="GET" class="d-flex flex-column gap-3">

                        <!-- Category Dropdown -->
                        <div>
                            <label class="fw-bold text-success">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    @if($category->parent_id !== null)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Type Dropdown -->
                        <div>
                            <label class="fw-bold text-success">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                                <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div>
                            <label class="fw-bold text-success">Occurence Date</label>
                            <input type="date" name="occurrence_date" class="form-control" value="{{ request('occurrence_date') }}">
                        </div>

                        <!-- Text Search -->
                        <div>
                            <label class="fw-bold text-success">Keyword</label>
                            <input type="text" name="title" class="form-control" placeholder="Search by name or description" value="{{ request('search') }}">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success w-50">Search</button>
                            <a href="{{ route('post.all_posts') }}" class="btn btn-outline-secondary w-50">Clear</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Posts List -->
        <div class="col-md-9">
            <div class="row justify-content-center">
                @forelse($posts as $post)
                    @php
                        $images = json_decode($post->images, true);
                        $firstImage = $images[0] ?? null;
                    @endphp

                    <a href="{{ route('post.view_post_details', $post->id) }}" class="text-decoration-none text-dark mb-3">
                        <div class="d-flex border shadow-sm hover-shadow rounded">
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
                    </a>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No posts found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
