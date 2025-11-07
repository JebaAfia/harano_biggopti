
@extends('main_design')

@section('post.all_posts')
    <div class="container py-5">
        <div class="row">
            <!-- Topbar Filters -->
            <div class="card shadow-sm rounded mb-4">
                <div class="card-body">
                    <form action="{{ route('post.all_posts') }}" method="GET" class="row g-3 align-items-end">

                        <!-- Category Dropdown -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-success">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id !== null)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Type Dropdown -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-success">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                                <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
                                <option value="resolved" {{ request('type') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>

                        <!-- Occurrence Date -->
                        <div class="col-md-2">
                            <label class="form-label fw-bold text-success">Occurrence Date</label>
                            <input type="date" name="occurrence_date" class="form-control"
                                value="{{ request('occurrence_date') }}">
                        </div>

                        <!-- Keyword Search -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-success">Keyword</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="Search by name or description" value="{{ request('title') }}">
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-success flex-fill">Search</button>
                            <a href="{{ route('post.all_posts') }}" class="btn btn-outline-secondary flex-fill">Clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="section properties">
                <div class="container">
                    <div class="row properties-box">
                        @forelse($posts as $post)
                            <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
                                <div class="item">
                                    @php
                                        $images = json_decode($post->images, true);
                                        $firstImage = $images[0] ?? null;
                                    @endphp

                                    @if ($firstImage)
                                        <img src="{{ asset($firstImage) }}" alt="{{ $post->title }}"
                                            style="width:100%; height:200px;">
                                    @else
                                        <img src="{{ asset('default.jpg') }}" alt="No Image"
                                            style="width:350px; height:200px;">
                                    @endif

                                    <span class="category">{{ $post->title }}</span>
                                    <h6>{{ $post->type }}</h6>
                                    <h4>Occurrence Date: {{ $post->occurrence_date }}</h4>
                                    <ul>
                                        <li>Category: <span>{{ $post->category->category_name ?? 'Uncategorized' }}</span>
                                        </li>
                                    </ul>
                                    <div class="main-button">
                                        <a href="{{ route('post.view_post_details', $post->id) }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">No posts found.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($posts->onFirstPage())
                                    <li class="disabled"><span>&laquo;</span></li>
                                @else
                                    <li><a href="{{ $posts->previousPageUrl() }}">&laquo;</a></li>
                                @endif

                                {{-- Page Number Links --}}
                                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                    <li class="{{ $posts->currentPage() == $page ? 'is_active' : '' }}">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($posts->hasMorePages())
                                    <li><a href="{{ $posts->nextPageUrl() }}">&raquo;</a></li>
                                @else
                                    <li class="disabled"><span>&raquo;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
