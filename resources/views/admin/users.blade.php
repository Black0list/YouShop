@extends('dashboard')

@section('content')
    <div>
        <div class="flex-wrap justify-content-xl-center d-flex" style="width: 100%; gap: 20px">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="table-light">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role)
                                <form method="POST" action="{{ url('/admin/user/update') }}" id="statusForm">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-select" name="role" onchange="this.form.submit()">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{$role->name === $user->role->name ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="user" value="{{ $user->id }}">
                                </form>
                            @else
                                <form method="POST" action="{{ url('/admin/user/update') }}" id="statusForm">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-select" name="role" onchange="this.form.submit()">
                                        @foreach($roles as $role)
                                            <option selected disabled>No Role</option>
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="user" value="{{ $user->id }}">
                                </form>
                            @endif
                        </td>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
