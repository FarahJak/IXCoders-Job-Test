@extends('dashboard')

@section('page-header')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Users</a>
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
    </nav>
@endsection

@section('content')
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">Add</button>
        <table class="table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()->first() }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#EditModal{{ $user->id }}">Edit</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#DeleteModal{{ $user->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <!-- EditModal -->
                        <div class="modal fade" id="EditModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="inputAddress"
                                                        name="name" value="{{ old('name') ?? $user->name }}"
                                                        placeholder="Please Enter User Name">
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="inputAddress"
                                                        name="email" value="{{ old('email') ?? $user->email }}"
                                                        placeholder="Please Enter User Email">
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="inputAddress"
                                                        name="password" placeholder="Please Enter User Password">
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Role</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="role_name">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}">
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
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
                        <div class="modal fade" id="DeleteModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <h6 class="text-center">Do you want to delete this <b>User</b>?</h6>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputAddress" name="name"
                                    placeholder="Please Enter The User Name">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Email</label>
                                <input type="text" class="form-control" id="inputAddress" name="email"
                                    placeholder="Please Enter The User Email">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Password</label>
                                <input type="text" class="form-control" id="inputAddress" name="password"
                                    placeholder="Please Enter The User Password">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Role</label>
                                <select class="form-select" aria-label="Default select example" name="role_name">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
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
