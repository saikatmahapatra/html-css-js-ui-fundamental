//-----------------------------------------------------------//
// jQuery AJAX API Promise Handler
//-----------------------------------------------------------//
var Ajax = function() {
    this.type = 'GET', //http methods. post|get|put|delete|option
	this.url = '', // API url
	this.data = {}, // add your request parameters in the data object. {"name"="john","email":"john@ex.com"}
	this.dataType = 'json', // specify the dataType for future reference. json|jsonp|html|text
	this.async = true, // async. true|false
	this.processData = true, // true|false
	this.cache = true, // default is true, but false for dataType 'script' and 'jsonp', so set it on need basis.
	this.jsonp = 'callback', // only specify this to match the name of callback parameter your API is expecting for JSONP requests.
	this.statusCode = { // if you want to handle specific error codes, use the status code mapping settings.
		404: this.handler404,
		500: this.handler500
	}
    this.beforeSend = function() {
        //show ajax loader 
    };
    this.handler404 = function() {};
    this.handler500 = function() {};

    //return promise
    this.init = function() {
        return $.ajax({
            type: this.type,
            url: this.url,
            data: this.data,
            dataType: this.dataType,
            async: this.async,
            processData: this.processData,
            //cache: this.cache,
            //jsonp: this.jsonp,
            //statusCode:this.statusCode,
            beforeSend: this.beforeSend
        });
    }
};