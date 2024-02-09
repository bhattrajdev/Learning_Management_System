@extends('layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                @include('_messages')
                <div class="d-flex mt-2">
                    <h2 class="mr-auto">{{ $name }}</h2>
                    <a href="{{ url('/admin/admin/list/create') }}"> <button class="btn btn-success"><i
                                class="fas fa-plus"></i> {{ $name }}</button></a>

                </div>



                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ $value['email'] }}</td>
                                    <td>
                                        <a href="{{ url('admin/admin/list/' . $value['id'] . '/edit') }}"><button
                                                class="btn btn-primary"><i class="fas fa-edit mr-2"></i>Edit</button></a>
                                        <form action={{ url('/admin/admin/list/' . $value['id']) }} emth>
                                            @method('delete')
                                            <button class="btn btn-danger" onclick="return(confirm('Are you sure?'))"><i
                                                    class="fas fa-trash mr-2"></i>Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
@endsection
