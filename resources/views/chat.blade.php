@extends('layout')

@section('content')
    <div class="row heading"></div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card mt-4">
                        <div class="card-header user-online mb-3">
                            <h5 class="mt-1 mb-2">{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['lastName'] }} - Online</h5>
                        </div>
                        <div class="chat">
                            <div id="chat">
                                <form onsubmit="return enterName();">
                                    <input class="input-name" id="name" value="{{ $LoggedUserInfo['firstName'] }} {{ $LoggedUserInfo['lastName'] }}" readonly>
                                    <button class="btn-outline-dark" type="submit">JOIN</button>
                                </form>
                            </div>
                            <ul class="list-group" id="users"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6 col-sm-12">
                    <div class="card mt-4" id="card" hidden>
                        <div class="card-header mb-2 d-flex justify-content-end">
                            <h6 class="user-name ml-2 mt-1" id="title"></h6>
                            <img class="card-image ml-2" src="{{ asset('img/user.png') }}">
                        </div>
                        <div class="chat">
                            <div class="row chat-box ml-1 mr-1">
                                <form class="chat-input" onsubmit="return sendMessage();">
                                    <input autocomplete="off" class="chat-submit block" id="message" placeholder="Type.....">
                                    <button class="button" type="submit" value="SEND"><i class="ml-2 fa fa-paper-plane" aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <div class="row chat-row">
                                <ul id="messages"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var io = io("http://localhost:3000");

        let receiver = "";
        let sender = "";

        function enterName() {
            var name = document.getElementById("name").value;

            io.emit("user_connected", name);
            sender = name;

            var chat = document.getElementById("chat");
            if (chat.style.display === "none") {
                chat.style.display = "block";
            } else {
                chat.style.display = "none";
            }

            event.preventDefault();
        }

        io.on("user_connected", function (username) {
            let html = "";
            html += "<li class='user-role'><button class='shadow btn-block user-submit' onclick='onUserSelected(this.innerHTML);'>" + username + "</li></button>";

            document.getElementById("users").innerHTML += html;
        });

        function onUserSelected(username) {
            receiver = username;
            document.getElementById("card").hidden = false;
            document.getElementById("title").innerHTML = username;
        }

        function sendMessage() {
            let message = document.getElementById("message").value;

            io.emit("send_message", {
                sender: sender,
                receiver: receiver,
                message: message
            });

            let html = "";
            html += "<li class='my-chat'>" + "You said: " + message + "</li><br><br>";

            document.getElementById("messages").innerHTML += html;

            return false;
        }

        io.on("new_message", function (data) {
           let html = "";
           html += "<li class='user-chat'>" + data.sender + " says: " + data.message + "</li><br><br>";

           document.getElementById("messages").innerHTML += html;
        });

    </script>
@endsection

