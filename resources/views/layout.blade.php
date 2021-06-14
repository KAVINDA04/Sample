<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>IP Live Chat</title>
    <link rel="icon" href="{{asset('img/icon.jpg')}}" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/semi-dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/package-lock.json')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <script>

        var io = io("http://localhost:3000", {'multiplex': false});

        let receiver = "";
        let sender = "";

        let date = new Date();
        let HH = date.getHours();
        let MM = date.getMinutes();
        let SS = date.getSeconds();

        window.onload = function() {

            fetch("http://localhost:3000/users")
                .then(response => response.json())
                .then(result => {
                    if (result) {
                        let html = "";

                        result.forEach(user => {
                            html += "<li class='user-role'><button class='shadow btn-block user-submit' onclick='onUserSelected(this.innerHTML);'>" + user.name + "</li></button>";

                            document.getElementById("users").innerHTML = html;
                        });
                    }
                })
                .catch(err => {
                   console.log(err);
                });

            var name = document.getElementById("name").value;


            io.emit("user_connected", name);
            sender = name;
            io.connect();
            var chat = document.getElementById("chat");
            if (chat.style.display === "none") {
                chat.style.display = "block";
            } else {
                chat.style.display = "none";
            }
        };

        io.on("user_connected", function (username) {
            let html = "";

            html += "<li class='user-role'><button class='shadow btn-block user-submit' onclick='onUserSelected(this.innerHTML);'>" + username + "</li></button>";

            document.getElementById("users").innerHTML += html;
        });

        /*function enterName() {
            var name = document.getElementById("name").value;

            console.log(name);

            io.emit("user_connected", name);
            sender = name;
            io.connect();
            var chat = document.getElementById("chat");
            if (chat.style.display === "none") {
                chat.style.display = "block";
            } else {
                chat.style.display = "none";
            }

            event.preventDefault();
        }*/

        function onUserSelected(username) {
            const currentUser = document.getElementById("connectedUser").innerHTML;
            receiver = username;
            document.getElementById("card").hidden = false;
            document.getElementById("cardOnload").hidden = true;
            document.getElementById("title").innerHTML = username;

            $.ajax({
                url: "http://localhost:3000/get_messages",
                method: "POST",
                data: {
                    sender: sender,
                    receiver: receiver
                },
                success: function (response) {
                    var messages = JSON.parse(response);
                    var html = "";

                    messages.forEach(function(m) {
                        if (currentUser === m.sender)
                            return html += "<li id='my-chat' class='my-chat'>" + " You said: " + m.message + "<div class='float-right'>" + m.created_at + "</div>" + "</li><br>";
                        else
                            return html += "<li class='user-chat'>" + m.sender + " says: " + m.message + "<div class='float-right'>" + m.created_at + "</div>" + "</li><br>";
                    });
                    document.getElementById("messages").innerHTML = html;
                    $(document).ready(function () {
                        $('#chat-area').animate({scrollTop: 1000000}, 10);
                    });
                }
            });
        }


        function sendMessage() {
            let message = document.getElementById("message").value;

            io.emit("send_message", {
                sender: sender,
                receiver: receiver,
                message: message
            });

            let html = "";
            html += "<li class='my-chat'>" + "You said: " + message + "<div class='float-right'>" + HH + ':' + MM + ':' + SS + "</div>" + "</li><br><br>";
            document.getElementById("messages").innerHTML += html;

            document.getElementById("message").value = '';
            $(document).ready(function () {
                $('#chat-area').animate({scrollTop: 1000000}, 10);
            });
            return false;
        }

        io.on("new_message", function (data) {

            let html = "";
            html += "<li class='user-chat'>" + data.sender + " says: " + data.message + "<div class='float-right'>" + HH + ':' + MM + ':' + SS + "</div>" + "</li><br><br>";

            document.getElementById("messages").innerHTML += html;
            $(document).ready(function () {
                $('#chat-area').animate({scrollTop: 1000000}, 10);
            });
        });

    </script>

</head>
<body style="background: linear-gradient(to right, #f4524d 0%, #5543ca 100%)">
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
