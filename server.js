const express = require("express");
const app = express();
const cors = require('cors');

const http = require("http").createServer(app);

app.use(cors());

const io = require("socket.io")(http, {
    cors: { origin: "*"}
});

const bodyParser = require("body-parser");

app.use(bodyParser.urlencoded());

//database
const mysql = require("mysql");

const connection = mysql.createConnection({
   "host": "localhost",
    "user": "root",
    "password": "",
    "database": "crud"
});

connection.connect(function (error) {

});

app.use(function (request, result, next) {
    result.setHeader("Access-Control-Allow-Origin", "*");
    next();
});

app.post("/get_messages", function (request, result) {
    connection.query("SELECT * FROM messages WHERE (sender = '" + request.body.receiver + "' AND receiver = '" + request.body.sender + "') OR (sender = '" + request.body.sender + "' AND receiver = '" + request.body.receiver + "')", function (error, messages) {
        result.end(JSON.stringify(messages));
    });

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

       connection.query("INSERT INTO messages (sender, receiver, message) VALUES ('" + data.sender + "', '" + data.receiver + "', '" + data.message + "')", function (error, result) {

       });
    });

    socket.on('disconnect', (socket) => {

    });
});

http.listen(3000, function () {
   console.log("Server started");
});
