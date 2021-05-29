@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2 class="text-center">USER DETAILS</h2>
        </div>
    </div>

    <div class="row" align="left">
        <div class="d-flex justify-content-center mb-4 mt-2">
            <a class="btn btn-success" href="{{route('user.create')}}">New User</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <div class="col-lg-12">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Option</th>
            </tr>

            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <div class="d-flex">
                        <button><a href="{{route('user.edit', $user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                        <form method="post" action="{{route('user.destroy', $user->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="outline-none"><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
