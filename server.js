var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);

//Set path, so that we can use css, js or node_modules as src directory in html pages
var path = require('path');
app.use(express.static(path.join(__dirname, '/')));

// define arrays
users = [];
connections = [];

//start listening
server.listen(process.env.PORT || 3000);
console.log('Server is running on https://localhost:3000');

//app route
app.get('/', function (req, res) {
	res.sendFile(__dirname + '/index_page.html');
});

//open a connection with socket.io
io.sockets.on('connection', function (socket) {
	// all the events goes here

	//Connect event
	connections.push(socket);
	console.log('Connected : %s sockets connected', connections.length);

	// Disconnect event
	socket.on('disconnect', function (data) {
		//if(!socket.username) return;
		users.splice(users.indexOf(socket.username), 1);
		updateUsernames();
		connections.splice(connections.indexOf(socket), 1);
		console.log('Disconnected: %s sockets connected', connections.length);
	});

	//Send Message
	socket.on('send message', function (data) {
		//console.log(data);
		io.sockets.emit('new message', { msgTxt: data, userName: socket.username });
	});

	// New User
	socket.on('new user', function (data, callback) {
		callback(true);
		socket.username = data;
		users.push(socket.username);
		updateUsernames();
	});

	function updateUsernames() {
		io.sockets.emit('get users', users);
	}
	
	socket.on('typing', function (data) {
		console.log(data);
		io.sockets.emit('typing', {userName: socket.username });
	});

});