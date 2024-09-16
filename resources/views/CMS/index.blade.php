@extends('layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <span class="fs-3">List accounts</span>
    </div>
    <div class="card shadow border-0">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-striped" id="account-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allUser as $account)
                    <tr>
                        <td>{{ $account->detail->first_name }} {{ $account->detail->middle_name }} {{ $account->detail->last_name }}</td>
                        <td>{{ $account->detail->department->name }}</td>
                        <td>
                            @if($account->validation === null)
                                <!-- if no records in validation -->
                                Not validated.
                                @else
                                <!-- if existing record -->
                                    Validated by {{ $account->validation->validatedBy->detail->first_name }}
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="" class="btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route($userRole . '.account.edit', $account->id) }}" class="dropdown-item">Edit</a>
                                    </li>
                                    <li>
                                        @if($account->validation === null)
                                            <form action="{{ route($userRole. '.account.validate', ['userId' => $account->id]) }}" method="post">
                                                @csrf
                                                <input type="submit" value="Validate" class="dropdown-item">
                                            </form>
                                            @else
                                            <form action="{{ route($userRole. '.account.unvalidate', ['userId' => $account->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Unvalidate" class="dropdown-item">
                                            </form>
                                        @endif
                                    </li>
                                    @if(Auth::user()->role === 'superadmin')
                                        <li>
                                            <form action="#" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this account?')">Delete</button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    $(document).ready(function() {
        $('#account-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });
    </script>
@endpush
@endsection