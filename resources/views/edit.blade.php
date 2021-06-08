@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-4">
                    <strong class="card-title text-center mx-auto">EDIT USER DETAILS</strong>
                </div>
                <form action="{{route('user.update', $user->id)}}" method="POST">
                    @csrf
                    <div class="col-sm-12">
                        <div class="left">
                            <label for="firstName" class="label">First Name</label>
                            <input id="firstName" type="text" name="firstName" value="{{$user->firstName}}" class=" form-control effect" placeholder="Roy...">
                            <p style="color: red">@error('firstName') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="lastName" class="label">Last Name</label>
                            <input id="lastName" type="text" name="lastName" value="{{$user->lastName}}" class="form-control effect" placeholder="Pearson...">
                            <p style="color: red">@error('lastName') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="mobile" class="label">Mobile</label>
                            <input id="mobile" type="text" name="mobile" value="{{$user->mobile}}" class="form-control effect" placeholder="0704467943">
                            <p style="color: red">@error('mobile') {{$message}} @enderror</p>
                        </div>
                        <div class="left">
                            <label for="email" class="label">Email</label>
                            <input id="email" type="text" name="email" value="{{$user->email}}" class="form-control effect" placeholder="name@example.com">
                            <p style="color: red">@error('email') {{$message}} @enderror</p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


