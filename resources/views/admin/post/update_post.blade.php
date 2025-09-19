@extends('admin.main_design')

@section('update_post')
@if (session('post_message'))
    <div class="alert alert-success" role="alert">
        {{ session('post_message') }}
    </div>
@endif

<div class="container-fluid p-4">
    <h3 class="mb-4" style="color:#2e7d32;">Update Post</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.post.post_update_post', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Title -->
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ old('title', $post->title) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $post->description) }}</textarea>
                    </div>

                    <!-- Hidden Proof -->
                    <div class="col-md-6">
                        <label for="hidden_proof" class="form-label fw-bold">Hidden Proof</label>
                        <input type="text" name="hidden_proof" id="hidden_proof" class="form-control"
                               value="{{ old('hidden_proof', $post->hidden_proof) }}">
                    </div>

                    <!-- Occurrence Time -->
                    <div class="col-md-6">
                        <label for="occurrence_time" class="form-label fw-bold">Occurrence Time</label>
                        <input type="time" name="occurrence_time" id="occurrence_time" class="form-control"
                               value="{{ old('occurrence_time', $post->occurrence_time) }}">
                    </div>

                    <!-- Occurrence Date -->
                    <div class="col-md-6">
                        <label for="occurrence_date" class="form-label fw-bold">Occurrence Date</label>
                        <input type="date" name="occurrence_date" id="occurrence_date" class="form-control"
                               value="{{ old('occurrence_date', $post->occurrence_date) }}">
                    </div>

                    <!-- Location -->
                    <div class="col-md-6">
                        <label for="location" class="form-label fw-bold">Location</label>
                        <input type="text" name="location" id="location" class="form-control"
                               value="{{ old('location', $post->location) }}">
                    </div>

                    <!-- Contact Number -->
                    <div class="col-md-6">
                        <label for="contact_number" class="form-label fw-bold">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control"
                               value="{{ old('contact_number', $post->contact_number) }}">
                    </div>

                    <!-- Hide Private Info -->
                    <div class="col-md-6">
                        <label for="hide_private_info" class="form-label fw-bold">Hide Private Info</label>
                        <input type="text" name="hide_private_info" id="hide_private_info" class="form-control"
                               value="{{ old('hide_private_info', $post->hide_private_info) }}">
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <label for="type" class="form-label fw-bold">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="lost" {{ old('type', $post->type) == 'lost' ? 'selected' : '' }}>Lost</option>
                            <option value="found" {{ old('type', $post->type) == 'found' ? 'selected' : '' }}>Found</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ old('status', $post->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $post->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>

                    <!-- Images -->
                    <div class="col-md-12">
                        <label for="images" class="form-label fw-bold">Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        <div class="mt-2 d-flex flex-wrap">
                            @if($post->images)
                                @foreach(json_decode($post->images, true) as $image)
                                    <img src="{{ asset($image) }}" alt="Image"
                                         class="me-2 mb-2 rounded shadow-sm"
                                         style="width:80px; height:80px; object-fit:cover;">
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success px-4">Update</button>
                    <a href="{{ route('admin.post.view_post') }}" class="btn btn-secondary px-4">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
