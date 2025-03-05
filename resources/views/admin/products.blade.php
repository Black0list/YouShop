@extends('dashboard')

@section('content')
    <div>
        <!-- Button trigger modal -->
        <div>
            <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Product
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-light text-dark dark-mode">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registerForm" method="POST" action="/admin/product/create"  enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="input-group mb-3 border-2">
                                <label class="input-group-text" for="inputGroupFile01">Upload Image</label>
                                <input type="file" name="image" class="form-control" id="inputGroupFile01">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">$Price</label>
                                <input type="number" class="form-control" name="price" id="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" required>
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
                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-wrap justify-content-xl-center d-flex" style="width: 100%; gap: 20px">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Added By</th>
                    <th scope="col">Category</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="table-light">
                @foreach($products as $product)
                    <tr>
                        <td style="width: 10%"><img src="{{ url('/storage/' . $product->image) }}"></td>
                        <td><strong>{{ $product->title }}</strong></td>
                        <td>${{ $product->price }}</td>
                        <td><span class="badge bg-primary">{{ $product->stock }}</span></td>
                        <td><span class="badge bg-success">{{ $product->user->name }}</span></td>
                        <td><span class="badge bg-primary">{{ $product->subcategory->name }}</span></td>
                        <td>
                            <form action="{{ url('/admin/product/get') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Update
                                </button>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                            </form>

                            <form action="{{ url('/admin/product/delete') }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
