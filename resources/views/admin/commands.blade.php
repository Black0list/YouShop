@extends('dashboard')

@section('content')
    <div>
        <div class="flex-wrap justify-content-xl-center d-flex" style="width: 100%; gap: 20px">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Command Number</th>
                    <th scope="col">Client</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody class="table-light">
                @foreach($commands as $command)
                    <tr>
                        <td>{{ $command->id }}</td>
                        <td>{{ $command->user->name }}</td>
                        <td>{{ $command->total_price }}</td>
                        <td>
                            <form method="POST" action="{{ url('/admin/command/update') }}" id="statusForm">
                                @csrf
                                @method('PUT')
                                <select class="form-select" name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $command->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="shipped" {{ $command->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $command->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                <input type="hidden" name="command" value="{{ $command->id }}">
                            </form>
                        </td>
                @endforeach
                </tbody>
            </table>
            {{ $commands->links() }}
        </div>
    </div>
@endsection
