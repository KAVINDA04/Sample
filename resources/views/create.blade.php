@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-4">
            <h2 class="text-center">REGISTER</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-7 mt-4">
            <form action="{{route('user.store')}}" method="POST">
                @csrf
                <div class="col-sm-4">
                    <div class="left">
                        <strong class="">Name</strong>
                        <input id="name" type="text" name="name" class="form-control" placeholder="name"><br>
                        <p style="color: red">@error('name') {{$message}} @enderror</p>
                    </div>
                    <div class="left">
                        <strong>Email</strong>
                        <input id="email" type="text" name="email" class="form-control" placeholder="email"><br>
                        <p style="color: red">@error('email') {{$message}} @enderror</p>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
