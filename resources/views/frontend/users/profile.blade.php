@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>User Profile
                        <a href="{{ route('profile.passwordCreate') }}" class="btn btn-warning float-end text-light">Change Password?</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                <div class="col-md-10">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <ul class="alert alert-warning px-4">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="card card-shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-2 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" value="{{ Auth::user()->name }}" name="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email Address</label>
                                            <input type="email" readonly value="{{ Auth::user()->email }}" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Pin Code</label>
                                            <input type="text" name="pincode" value="{{ Auth::user()->userDetail->pincode ?? '' }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" rows="3">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-sm btn-success float-end text-light">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
