@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-4">
                    <strong class="card-title text-center mx-auto">REGISTER</strong>
                </div>
                <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-12">
                        <div class="left">
                            <label for="firstName" class="label">First Name</label>
                            <input id="firstName" type="text" name="firstName" class=" form-control effect" placeholder="Roy..." value="{{old('firstName')}}">
                            <p style="color: red">@error('firstName') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="lastName" class="label">Last Name</label>
                            <input id="lastName" type="text" name="lastName" class="form-control effect" placeholder="Pearson..." value="{{old('lastName')}}">
                            <p style="color: red">@error('lastName') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="mobile" class="label">Mobile</label>
                            <input id="mobile" type="text" name="mobile" class="form-control effect" placeholder="0704467943" value="{{old('mobile')}}">
                            <p style="color: red">@error('mobile') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="text" name="email" class="form-control effect" placeholder="name@example.com" value="{{old('email')}}">
                            <p style="color: red">@error('email') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="password" class="label">Password</label>
                            <input id="password" type="password" name="password" class="form-control effect">
                            <p style="color: red">@error('password') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <input id="image" type="file" name="image" class="form-control effect">
                            <p style="color: red">@error('image') {{$message}} @enderror</p>
                        </div>
                        <a href="{{route('user.login')}}">I already have an account, Sign in</a>
                        <button type="submit" class="btn btn-primary btn-block mb-4 mt-4">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
