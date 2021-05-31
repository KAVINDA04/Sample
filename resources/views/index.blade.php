@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="card mt-4 container">
        <div class="row justify-content-center">
            <div class="card-header pb-4">
                <strong class="card-title text-center mx-auto">USER DETAILS</strong>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-warning">
                    <p>{{$message}}</p>
                </div>
            @endif

            <div class="row">
                <div class="justify-content-left mb-4 mt-2">
                    <a class="btn btn-success" href="{{route('user.create')}}">New User</a>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Option</th>
                </tr>

                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->firstName}}</td>
                    <td>{{$user->lastName}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <div class="d-flex">
                            <button class="button"><a href="{{route('user.edit', $user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                            <form method="post" action="{{route('user.destroy', $user->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="button"><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
