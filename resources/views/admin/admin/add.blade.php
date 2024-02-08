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

                <form action="{{ url('/admin/admin/list') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.card -->
@endsection
