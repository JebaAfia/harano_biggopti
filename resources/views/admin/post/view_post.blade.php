@extends('admin.main_design')

@section('view_post')
@if (session('post_message'))
    <div class="alert alert-success" role="alert">
        {{ session('post_message') }}
    </div>
@endif

<div class="container-fluid p-4">
    <h3 class="mb-4" style="color:#2e7d32;">All Posts</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>SL No</th>
                        <th>Title</th>
                        <th>Occurrence Time</th>
                        <th>Occurrence Date</th>
                        <th>Location</th>
                        <th>Contact Number</th>
                        <th>Images</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $key => $post)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->occurrence_time }}</td>
                            <td>{{ $post->occurrence_date }}</td>
                            <td>{{ $post->location }}</td>
                            <td>{{ $post->contact_number }}</td>
                            <td>
                                @if($post->images)
                                    @foreach(json_decode($post->images, true) as $image)
                                        <img src="{{ asset($image) }}" alt="Image" width="50" height="50" class="rounded mb-1">
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ ucfirst($post->type) }}</td>
                            <td>
                                <span class="badge bg-{{ $post->status == 'approved' ? 'success' : 'warning' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ $post->category->category_name ?? 'N/A' }}</td>
                            <td>
                                <!-- View Button -->
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#postModal{{ $post->id }}">
                                View
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="postModal{{ $post->id }}" tabindex="-1" aria-labelledby="postModalLabel{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">

                                        <!-- Header -->
                                        <div class="modal-header bg-success text-white rounded-top-4">
                                            <h5 class="modal-title fw-bold" id="postModalLabel{{ $post->id }}">
                                                <i class="bi bi-card-text me-2"></i> Post Details
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Body -->
                                        <div class="modal-body">
                                            <div class="row g-3">

                                                <div class="col-12">
                                                    @php
                                                        $infoFields = [
                                                            'Title' => ['icon' => 'bi-card-heading', 'value' => $post->title],
                                                            'Description' => ['icon' => 'bi-file-text', 'value' => $post->description ?? 'N/A'],
                                                            'Hidden Proof' => ['icon' => 'bi-shield-lock', 'value' => $post->hidden_proof ?? 'N/A'],
                                                            'Occurrence Time' => ['icon' => 'bi-clock', 'value' => $post->occurrence_time],
                                                            'Occurrence Date' => ['icon' => 'bi-calendar', 'value' => $post->occurrence_date],
                                                            'Location' => ['icon' => 'bi-geo-alt', 'value' => $post->location],
                                                            'Contact Number' => ['icon' => 'bi-telephone', 'value' => $post->contact_number],
                                                            'Hide Private Info' => ['icon' => 'bi-eye-slash', 'value' => $post->hide_private_info ?? 'N/A'],
                                                            'Type' => ['icon' => 'bi-tag', 'value' => ucfirst($post->type)],
                                                            'Status' => ['icon' => 'bi-check2-circle', 'value' => ucfirst($post->status), 'badge' => $post->status == 'approved' ? 'success' : 'warning'],
                                                            'Category' => ['icon' => 'bi-bookmark', 'value' => $post->category->category_name ?? 'N/A'],
                                                        ];
                                                    @endphp

                                                    @foreach($infoFields as $label => $info)
                                                        <div class="d-flex justify-content-between align-items-start mb-2 p-2 rounded-3" style="background: #f8f9fa;">
                                                            <div>
                                                                <h6 class="mb-1"><i class="bi {{ $info['icon'] }} me-2 text-success"></i>{{ $label }}</h6>
                                                                <p class="mb-0">
                                                                    @if(isset($info['badge']))
                                                                        <span class="badge bg-{{ $info['badge'] }}">{{ $info['value'] }}</span>
                                                                    @else
                                                                        {{ $info['value'] }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <!-- Images -->
                                                    <div class="mt-3">
                                                        <h6><i class="bi bi-images me-2 text-success"></i>Images</h6>
                                                        <div class="d-flex flex-wrap">
                                                            @if($post->images)
                                                                @foreach(json_decode($post->images, true) as $image)
                                                                    <img src="{{ asset($image) }}" alt="Image" class="me-2 mb-2 rounded shadow-sm" style="width:100px; height:100px; object-fit:cover;">
                                                                @endforeach
                                                            @else
                                                                <p class="text-muted">No images available</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="modal-footer border-0 d-flex justify-content-between">
                                            <span class="text-muted small">Post ID: {{ $post->id }}</span>
                                            <button type="button" class="btn btn-outline-success rounded-pill" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle"></i> Close
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                <a href="{{ route('admin.post.update_post', $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.post.delete_post', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16" class="text-center">No posts found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
