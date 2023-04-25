@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Slider List
                    <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Slider
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>{{ $slider->status == '0' ? 'Hidden' : 'Visible' }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($slider->image) }}" style="width: 70px; height: 70px;"
                                        alt="{{ $slider->title }}">
                                </td>
                                <td>
                                    <a href="{{ url('admin/sliders/' . $slider->id . '/edit') }}"
                                        class="btn btn-sm btn-success text-light">Edit</a>
                                    <a class="btn btn-sm btn-danger text-light" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure, you want to delete this slider?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <a class="btn btn-danger text-light"
                                                href="{{ url('admin/sliders/' . $slider->id . '/delete') }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7">No Sliders Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
