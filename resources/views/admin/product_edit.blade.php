@extends('dashboard')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Product</h4>
            </div>
            <div class="card-body">
                <form id="registerForm" method="POST" action="/admin/product/update"  enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3 border-2">
                        <label class="input-group-text" for="inputGroupFile01">Upload Image</label>
                        <input type="file" name="image" class="form-control" id="inputGroupFile01">
                        <div style="width: 10%"><img src="{{ url('storage/'. $product->image) }}"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" value="{{ $product->title }}" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" value="{{ $product->description }}" name="description" id="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">$Price</label>
                        <input type="number" class="form-control" value="{{ $product->price }}" name="price" id="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" value="{{ $product->stock }}" name="stock" id="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category" id="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="form-control" name="user" id="user" value="{{ Auth::user()->id }}" required>
                    <input type="hidden" class="form-control" name="product" id="product" value="{{ $product->id }}" required>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
