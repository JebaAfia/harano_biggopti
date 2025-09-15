@extends('admin.main_design')

@section('update_category')
@if (session('category_message'))
    <div class="alert alert-success" role="alert">
        {{ session('category_message') }}
    </div>
@endif

<div class="container-fluid p-4">
    <h3 class="mb-4" style="color:#2e7d32;">Update Category</h3>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('admin.category.post_update_category', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Name</label>
                            <input type="text"
                                   name="category_name"
                                   id="category_name"
                                   value="{{ old('category_name', $category->category_name) }}"
                                   class="form-control @error('category_name') is-invalid @enderror"
                                   placeholder="Enter category name"
                                   required>
                            @error('category_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   value="{{ old('slug', $category->slug) }}"
                                   class="form-control @error('slug') is-invalid @enderror"
                                   placeholder="Slug"
                                   required>
                            @error('slug')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Parent ID -->
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Category</label>
                            <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">-- None --</option>
                                @foreach($categories as $cat)
                                    @if(is_null($cat->parent_id))
                                        <option value="{{ $cat->id }}"
                                            {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Update Category
                            </button>
                            <a href="{{ route('admin.category.view_category') }}" class="btn btn-secondary ms-2">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
