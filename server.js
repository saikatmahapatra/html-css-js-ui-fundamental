var express = require('express');
var app = express();
var server = require('http').createServer(app);

//Set path, so that we can use css, js or node_modules as src directory in html pages
var path = require('path');
app.use(express.static(path.join(__dirname, '/')));

//start listening
server.listen(process.env.PORT || 3000);
console.log('Socket Server is running on https://localhost:3000');

//app route
app.get('/', function (req, res) {
	res.sendFile(__dirname + '/index.html');
});