@extends('main_design')

@section('post.new_post')
@if (session('post_message'))
    <div class="alert alert-success" role="alert">
        {{ session('post_message') }}
    </div>
@endif

  <!-- New Post Section -->
  <section class="report">
    <div class="container">
      <h2 class="text-center">Create a New Report</h2>
      <p class="text-center">Post details about a lost or found item to help reconnect it with its rightful owner.</p>

        <form action="{{ route('post.post_new_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Enter title"
                        value="{{ old('title') }}" required>
                @error('title')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter description" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Hidden Proof -->
            <div class="mb-3">
                <label for="hidden_proof" class="form-label">Hidden Proof</label>
                <input type="text" name="hidden_proof" id="hidden_proof"
                        class="form-control @error('hidden_proof') is-invalid @enderror"
                        placeholder="Enter hidden proof"
                        value="{{ old('hidden_proof') }}">
                @error('hidden_proof')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Occurrence Time -->
            <div class="mb-3">
                <label for="occurrence_time" class="form-label">Time</label>
                <input type="time" name="occurrence_time" id="occurrence_time"
                        class="form-control @error('occurrence_time') is-invalid @enderror"
                        value="{{ old('occurrence_time') }}">
                @error('occurrence_time')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Occurrence Date -->
            <div class="mb-3">
                <label for="occurrence_date" class="form-label">Date</label>
                <input type="date" name="occurrence_date" id="occurrence_date"
                        class="form-control @error('occurrence_date') is-invalid @enderror"
                        value="{{ old('occurrence_date') }}"
                        min="2000-01-01"
                        max="{{ date('Y-m-d') }}"
                        required>
                @error('occurrence_date')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location"
                        class="form-control @error('location') is-invalid @enderror"
                        placeholder="Enter location"
                        value="{{ old('location') }}">
                @error('location')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contact Number -->
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number"
                        class="form-control @error('contact_number') is-invalid @enderror"
                        placeholder="Enter contact number"
                        value="{{ old('contact_number') }}">
                @error('contact_number')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Hide Private Info -->
            <div class="mb-3">
                <label for="hide_private_info" class="form-label">Hide Private Info</label>
                <input type="text" name="hide_private_info" id="hide_private_info"
                        class="form-control @error('hide_private_info') is-invalid @enderror"
                        placeholder="Enter private info to hide"
                        value="{{ old('hide_private_info') }}">
                @error('hide_private_info')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Images -->
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images"
                        class="form-control @error('images.*') is-invalid @enderror"
                        multiple>
                @error('images.*')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type"
                        class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">-- Select Type --</option>
                    <option value="lost" {{ old('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                    <option value="found" {{ old('type') == 'found' ? 'selected' : '' }}>Found</option>
                </select>
                @error('type')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        @if(!is_null($category->parent_id))
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-plus me-1"></i> Add Post
                </button>
            </div>
        </form>
    </div>
  </section>

@endsection
