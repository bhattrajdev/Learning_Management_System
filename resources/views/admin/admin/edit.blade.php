@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="d-flex mt-2">
                    <h2 class="mr-auto">{{ $name }}</h2>
                    <a href="{{ url('/admin/admin/list') }}"> <button class="btn btn-success"><i class="fas fa-eye"></i>
                            View </button></a>

                </div>

                <form action="{{ url('/admin/admin/list/' . $records['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $records['name'] }}" name="name"
                                    placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $records['email'] }}" name="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <p>Only write the password if you want to set a new password</p>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- /.card -->
@endsection
