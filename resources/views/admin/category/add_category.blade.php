@extends('admin.main_design')

@section('add_category')
@if (session('category_message'))
    <div class="alert alert-success" role="alert">
        {{ session('category_message')}}
    </div>
@endif

<div class="container-fluid p-4">
    <h3 class="mb-4" style="color:#2e7d32;">Add Category</h3>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{route('admin.category.post_add_category')}}" method="POST">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter category name" required>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" required>
                            @error('slug')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Parent ID -->
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent ID</label>
                            <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">-- None --</option>
                                @foreach($categories as $category)
                                    @if(is_null($category->parent_id))
                                        <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
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
                                <i class="fa fa-plus me-1"></i> Add Category
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
