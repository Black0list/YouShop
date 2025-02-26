@extends('dashboard')

@section('content')
    <div>
        <!-- Button trigger modal -->
        <div>
            <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                add New Role
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
                        <form id="registerForm" method="POST" action="/admin/role/create" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="role_name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="name" id="role_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="role_description" class="form-label">Role Description</label>
                                <input type="text" class="form-control" name="description" id="role_description" required>
                            </div>
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
                    <th scope="col">Role Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Users</th>
                </tr>
                </thead>
                <tbody class="table-light">
                @foreach($roles as $role)
                    <tr>
                        <td><strong>{{ $role->name }}</strong></td>
                        <td>{{ $role->description }}</td>
                        <td>
                            @if($role->users->isNotEmpty())
                                <span class="badge bg-success">{{ $role->users->count() }} Users</span>
                                <ul class="list-unstyled m-0 p-0">
                                    @foreach($role->users as $user)
                                        <li>{{ $user->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="badge bg-secondary">No Users</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
