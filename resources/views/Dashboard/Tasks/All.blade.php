@extends('dashboard')

@section('page-header')
    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tasks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddModal">
                            Add
                        </button>
                    </li>

                </ul>
            </div>
        </div>
    </nav> --}}
@endsection

@section('content')
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">Add</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#EditModal{{ $task->id }}">Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#DeleteModal{{ $task->id }}">Delete</button>
                            </div>
                        </td>
                    </tr>

                    <!-- EditModal -->
                    <div class="modal fade" id="EditModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="inputAddress" name="title"
                                                    value="{{ old('title') ?? $task->title }}"
                                                    placeholder="Please Enter Task Name">
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="2"
                                                    placeholder="Please Enter Product Description">{{ old('description') ?? $task->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Status</label>

                                                <select class="form-select" name="status">
                                                    <option value="pending"
                                                        @if ($task->status == 'pending') selected @endif>Pending</option>
                                                    <option value="in_progress"
                                                        @if ($task->status == 'in_progress') selected @endif>In Progress
                                                    </option>
                                                    <option value="completed"
                                                        @if ($task->status == 'completed') selected @endif>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DeleteModal -->
                    <div class="modal fade" id="DeleteModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <h6 class="text-center">Do you want to delete this <b>Task</b>?</h6>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- AddModal -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Title</label>
                                <input type="text" class="form-control" id="inputAddress" name="title"
                                    placeholder="Please Enter The Task Title">
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="2"
                                        placeholder="Please Enter Product Description"></textarea>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">User owner</label>
                                    <select class="form-select" aria-label="Default select example"
                                        name="sub_category_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Task Images</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="inputGroupFile04"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="images[]"
                                            multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
