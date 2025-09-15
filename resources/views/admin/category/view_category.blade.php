@extends('admin.main_design')

@section('view_category')
@if (session('category_message'))
    <div class="alert alert-success" role="alert">
        {{ session('category_message')}}
    </div>
@endif

<div class="container-fluid p-4">
    <h3 class="mb-4" style="color:#2e7d32;">All Categories</h3>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Parent ID</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->parent_id)
                                            {{ $category->parent->category_name }}
                                        @else
                                            <span class="text-muted">Parent Category</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.update_category', $category->id) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.category.delete_category', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
