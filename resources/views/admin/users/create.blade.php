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

        @if ($errors->any())
            <ul class="alert alert-warning px-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Add User
                    <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/users') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="div col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="div col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="div col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="div col-md-6 mb-3">
                            <label>Select Role</label>
                            <select name="role" class="form-control">
                                <option value="" disabled selected>-- Select Role --</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="div col-md-12 mb-3">
                            <button type="submit" class="btn btn-sm btn-success float-end text-light">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
