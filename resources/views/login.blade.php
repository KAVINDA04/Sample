@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-4">
                    <strong class="card-title text-center mx-auto">LOGIN</strong>
                </div>
                <form action="{{route('user.check')}}" method="POST">

                    @if(Session::get('fail'))
                        <div style="margin-left: 10px; margin-right: 10px" class="alert alert-danger alertMessage">
                            <p>{{Session::get('fail')}}</p>
                        </div>
                    @endif

                    @csrf
                    <div class="col-sm-12">
                        <div class="left">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="text" name="email" class="form-control effect" placeholder="name@example.com">
                            <p style="color: red">@error('email') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="password" class="label">Password</label>
                            <input id="password" type="password" name="password" class="form-control effect">
                            <p style="color: red">@error('password') {{$message}} @enderror</p>
                        </div>
                        <a href="{{route('user.create')}}">I don't have an account, Sign up</a>
                        <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
