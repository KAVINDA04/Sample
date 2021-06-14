@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="card mt-4 container">
        <div class="row justify-content-center">
            <div class="card-header pb-4">
                <strong class="card-title text-center mx-auto">USER DETAILS</strong>
            </div>

            @if ($message = Session::get('success'))
                <div style="margin-left: 10px; margin-right: 10px" class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif

            <div class="row">
                <div class="d-flex">
                    {{--<div class="justify-content-left mb-4 mt-2">
                        <a class="btn btn-success" href="{{route('user.create')}}">New User</a>
                    </div>--}}
                    <div class="mt-2 mb-4 ml-4 d-flex">
                        <p class="btn btn-outline-dark userView mr-2">{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['firstName'] }}</p>

                        {{--<input class="input-name" id="name" value="{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['lastName'] }}" readonly>--}}
                        {{--<form onclick="enterName()">
                            <a class="btn btn-outline-dark userLogout ml-3" href="{{route('user.chat')}}"> Chat</a>
                        </form>--}}
                        <a class="btn btn-outline-primary userLogout ml-2" type="submit" href="{{route('user.logout')}}">Logout</a>
                        <a class="btn btn-outline-dark userLogout ml-3" href="{{route('user.chat')}}" onsubmit="enterName()">Open Chat</a>
                    </div>
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
                            <button class="button ml-3"><a href="{{route('user.edit', $user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                            <form method="post" action="{{route('user.destroy', $user->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                {{--<button class="button"><a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></button>--}}
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script>

    </script>
@endsection
