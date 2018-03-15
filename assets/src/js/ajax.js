/**
 * ------------------------------------------------------------------------------
 * jQuery AJAX API
 * ------------------------------------------------------------------------------
 */

/*$.ajax({
	type: 'POST', //post|get|put|delete|option
	url: 'http://api.something.com/registration', //api url
	data: {}, //{"name":"john","email":"john@ex.com"}
	dataType: 'json', // json|jsonp|html|text
	async: true, //true | false
	processData: true, // true | false
	// beforeSend : function(){} to show ajax loader
	beforeSend: function(){
		//show ajax loader
	},
	// success: function(){} when status 200 OK, then success
	success: function(data){
		console.log(data);
	},
	// complete: function(){} whether call fails or not this will be execute always
	complete: function(data){
		//hide ajax loader
	}, 
	// error: function(){} to show ajax error
	error: function(xhr, ajaxOptions, thrownError){
		console.log(xhr,thrownError);
	} 
});*/



/**
 * ------------------------------------------------------------------------------
 * jQuery AJAX API Promise Handler
 * ------------------------------------------------------------------------------
 */
var Ajax = function () {
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
    this.handler404 = function () { };
    this.handler500 = function () { };
    this.beforeSend = function () {
        //show ajax loader
    };

    //return promise
    this.init = function () {
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