@extends('dashboard')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Update SubCategory</h4>
            </div>
            <div class="card-body">
                <form id="registerForm" method="POST" action="/admin/subcategory/update" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" value="{{ $category->name }}" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">SubCategory Description</label>
                        <input type="text" class="form-control" value="{{ $category->description }}" name="description" id="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @if($cat->id === $category->category->id) selected @endif>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="category" value="{{ $category->id }}">
                    <button type="submit" class="btn btn-warning w-100"><i class="bi bi-pencil"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
