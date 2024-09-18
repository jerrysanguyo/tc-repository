@extends('layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-1">
        <span class="fs-3">{{ $pageTitle }}</span>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create{{ $pageTitle }}">
            Create a {{ $pageTitle }}
        </button>
        @include('cms.universal.create')
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
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->remarks }}</td>
                        <td>{{ $item->createdBy->detail->first_name }} {{ $item->createdBy->detail->last_name }}</td>
                        <td>{{ $item->updatedBy->detail->first_name }} {{ $item->updatedBy->detail->last_name }}</td>
                        <td>
                            <div class="dropdown">
                                <a href="" class="btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route($userRole . '.' . $pageTitle . '.edit', [$pageTitle => $item->id]) }}" class="dropdown-item">Edit</a>
                                    </li>
                                    @if($userRole === 'superadmin')
                                        <li>
                                            <form action="{{ route($userRole . '.' . $pageTitle . '.destroy', [$pageTitle => $item->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this {{ $pageTitle }}?')">Delete</button>
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
        $('#data-table').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
        });
    });
    </script>
@endpush
@endsection