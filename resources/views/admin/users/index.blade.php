@extends('layouts.admin')

@section('title', 'User List')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Users
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white float-end">Add User</a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <label class="badge btn-success text-light">Admin</label>
                                    @else
                                        <label class="badge btn-primary text-light">User</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/' . $user->id . '/edit') }}"
                                        class="btn btn-sm btn-success text-light">Edit
                                    </a>
                                    <a href="{{ url('admin/users/' . $user->id . '/delete') }}"
                                        onclick="return confirm('Are you sure, you want to delete this data?')"
                                        class="btn btn-sm btn-danger text-light">Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Users Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
