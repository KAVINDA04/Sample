const express = require("express");
const app = express();
const cors = require('cors');

const http = require("http").createServer(app);

app.use(cors());

const io = require("socket.io")(http, {
    cors: { origin: "*"}
});

const users = [];

io.on("connection", function (socket) {
    console.log("User connected", socket.id);

    socket.on("user_connected", function (username) {
        users[username] = socket.id;
        console.log(username);


        io.emit("user_connected", username)
    });

    socket.on("send_message", function (data) {
       const socketId = users[data.receiver];

       io.to(socketId).emit("new_message", data);
    });

    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

http.listen(3000, function () {
   console.log("Server started");
});
