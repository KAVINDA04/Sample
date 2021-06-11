@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-content d-flex">
                                <img class="card-image ml-2" src="{{ asset('images/File-1623321668.png') }}" alt="">
                                <div class="user-content">
                                    <span class="mt-1" id="connectedUser">{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['lastName'] }}</span>
                                    <p>online</p>
                                </div>
                            </div>
                            <a class="btn-outline-dark user-logout mt-1 mr-2" href="{{route('user.logout')}}">Logout</a>
                        </div>
                        <div class="chat">
                            <div id="chat">
                                <form onsubmit="return enterName();">
                                    <input class="input-name" id="name" value="{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['lastName'] }}" readonly>
                                    <button class="btn-outline-dark btn-join" type="submit">JOIN</button>
                                </form>
                            </div>
                            <ul class="list-group" id="users"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6 col-sm-12">
                    <div class="card mt-4" id="cardOnload">
                        <div class="card-header mb-4 d-flex justify-content-end">
                            <img class="card-image ml-2" src="{{ asset('img/user.png') }}" alt="">
                        </div>
                        <div class="chat">
                            <div class="row ml-1 mr-1 justify-content-center">
                                <img class="image-b" src="{{ asset('img/background.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4" id="card" hidden="true">
                        <div class="card-header d-flex justify-content-end">
                            <div class="user-content">
                                <span id="title"></span><br>
                                <p class="float-right">active now</p>
                            </div>
                            <img class="card-image ml-2" src="{{ asset('img/user.png') }}">
                        </div>
                        <section>
                            <div class="chat">
                                <div class="chat-area overflow-auto">
                                    <div class="row d-flex">
                                        <ul id="messages"></ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row chat-box ml-3">
                            <form class="chat-input" onsubmit="return sendMessage();">
                                <input autocomplete="off" class="chat-submit block" id="message" placeholder="Type....." value="">
                                <button class="button" type="submit" value="SEND"><i class="ml-3 fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

