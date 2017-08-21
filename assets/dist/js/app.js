/*! SampleWebApp app.js
* ================
* Main JS application file for SampleWebApp v2. This file
* should be included in all pages. It controls some layout
* options and implements exclusive SampleWebApp plugins.
*
* @Author  Saikat Mahapatra
* @Support 
* @Email   <mahapatra.saikat@gmail.com>
* @version 1.0.0
* @repository https://github.com/saikatmahapatra/sample-web-app-for-poc.git
* @license MIT <http://opensource.org/licenses/MIT>
*/

// Make sure jQuery has been loaded
if (typeof jQuery === 'undefined') {
throw new Error('SampleWebApp requires jQuery')
}

//----------------------------------------------------------------------//
// Main Application Object
//----------------------------------------------------------------------//
var mainApp = function(){
	this.validOTP = 1987;
	this.countCheckedCheckbox = function(el_class){
		var c = $('input[type="checkbox"][class="rc-checkbox"]:checked').length;
		return c;
	};
	this.removeDomElement = function(el){
		$(el).remove();
	};
	this.regEx = {
		user_id: /^[0-9\sA-Za-z\u00C0-\u00FF\~\#\";\/!@$%^&*()_\+\{\}\?\-\[\]\\,.\u0152\u0153\u20A0\u20A3\u0178\u20AC\u2013\u2014\u00C6\u00E6\u00C4\u00E4\u20A3]{5,32}$/,
        password: /^[^|]{6,32}$/,
        email: /^(?!.*([.])\1{1})([\w\.\-\+\<\>\{\}\=\`\|\?]+)@(?![.-])([a-zA-Z\d.-]+)\.([a-zA-Z.][a-zA-Z]{1,6})$/,
        create_user_id: /^[0-9\sA-Za-z\!@$%^*()_\+\{\}\?\-\[\]\\,.]{5,32}$/,
        four_consecutive_digits: /\d{4}/,
        create_password: /^(?=(?:.*?[0-9]){2})(?=.*[a-zA-Z])[0-9\sA-Za-z\!@\#$%^&*()_\+\{\}?\-\[\]\\,.]{6,32}$/,
        checkpoint_response: /^[0-9\sA-Za-z\?\#,.:;\\<|>!=@\#$%^*_\-\+\{\}\[\]]{1,}$/,
        formatted_date: /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/,
        formatted_date_with_stars_pattern: /^(0[1-9]|1[012]|\*\*)[- /.](0[1-9]|[12][0-9]|3[01]|\*\*)[- /.](((19|20)\d\d)|(\*\*\*\*))$/,
        cvv: /^\d{3,4}$/,
        last_four_digits: /^\d{4}$/,
        card_number_length: /^.{9,16}$/,
        card_number_format: /^[0-9]*$/,
        card_name: /^[a-zA-Z\s\-'\.]{4,30}$/,
        aba_routing: /^\d{1,9}$/,
        account_number: /^\d{1,17}$/,
        currency: /^\d{1,10}(\.\d{0,2})?$|^\.\d{1,2}$/,
        nickname: /^[\s\dA-Za-z\u00C0-\u00FF\!@\#$%^&\*\(\)_\+\{\}\?\-\=\[\]\,\.\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]{0,30}$/,
        card_nickname: /^[\s\dA-Za-z\u00C0-\u00FF\!@\#$%^&\*\(\)_\+\{\}\?\-\[\]\,\~\\\\|\/u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]{0,30}$/,
        three_repeating_characters: /(.)\1{2,}/,
        phone_number_US: /^\d{10}$/,
        has_a_number: /\d/,
        security_question_format: /^[0-9\sA-Za-z\u00C0-\u00FF0-9\u0152\u0153\u20A0\u0178\u20A3\u20AC\<\>\!@\#$%^*_\+\{\}|:\?\-\=\[\]\\;/.]*$/,
        whole_number: /^([1-9][0-9]*)$/,
        name: /^[A-Za-z\.\-\'\s,]*$/,
        name_with_latin_characters: /^[A-Za-z\.\-\'\s,\u00C0-\u00FF\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]*$/,
        numeric_only: /^[0-9]*$/,
        numeric_only_with_spaces: /^[0-9\s]*$/,
        numeric_two_decimal_places: /^\d+(\.\d{1,2})?$/,
        alpha_only: /^[A-Za-z]*$/,
		alpha_upper: /^[A-Z]*$/,
		alpha_lower: /^[a-z]*$/,
		is_special_char: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/,
        alpha_with_spaces: /^[A-Za-z\s]*$/,
        alpha_numeric_only: /^[0-9A-Za-z]*$/,
        alphanumeric_with_spaces: /^[A-Za-z0-9\s]*$/,
        balance_transfer_city: /^[A-Za-z\u00C0-\u00FF\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3\s\.]{1,18}$/,        
        zipcode: /^[0-9]{5,5}$/,
        postal_code: /^[A-Za-z][0-9][A-Za-z]\s[0-9][A-Za-z][0-9]$/,
        consecutive_spaces: /\s\s/,
        leading_or_trailing_spaces: /^[\s]+|[\s]+$/,
        activation_code: /^[A-Za-z0-9]{8}$/,
        dispute_charge_text: /^[^<>\"%]*$/,
        message_subject: /^[^=\"'<>]*$/,
        message_body: /^[^=\"'<>]*$/
	};
	this.countStringStrength = function(str){			
		var i = 0;
		var total_strength = 0;
		var strData = {
			string:str,
			length:str.length,
			strength: {value:0,displayText:'',css:''},						
			upper: {count: 0,strength:0},
			lower: {count: 0,strength:0},
			numeric: {count: 0,strength:0},
			special: {count: 0,strength:0},
		}
		
		while(i<str.length){
			var strChar = str.charAt(i);
			i++;
			if (app.regEx.alpha_upper.test(strChar)) {
			 strData.upper.count++;
			 strData.upper.strength++;
			 total_strength = total_strength+3;
			 strData.strength.value = total_strength;
			}
			else if (app.regEx.alpha_lower.test(strChar)){
			 strData.lower.count++;
			 strData.lower.strength++;
			 total_strength = total_strength+1;
			 strData.strength.value = total_strength;
			}
			else if (app.regEx.numeric_only.test(strChar)){
			 strData.numeric.count++;
			 strData.numeric.strength++;
			 total_strength = total_strength+2;
			 strData.strength.value = total_strength;
			}
			else if (app.regEx.is_special_char.test(strChar)){
			 strData.special.count++;
			 strData.special.strength++;
			 total_strength = total_strength+4;
			 strData.strength.value = total_strength;
			}			
		}	
		
		//strength indicator
		if(strData.strength.value < 6){
			strData.strength.displayText = 'Very Weak';
			strData.strength.css = 'danger';
		}		
		if(strData.strength.value == 6){
			strData.strength.displayText = 'Weak';
			strData.strength.css = 'warning';
		}		
		if(strData.strength.value > 6){
			strData.strength.displayText = 'Strong';
			strData.strength.css = 'success';
		}				
		return strData;		
	};
	this.readMultipleFiles = function(evt) {
		//Retrieve all the files from the FileList object
		var files = evt.target.files;     		
		if (files) {
			for (var i=0, f; f=files[i]; i++) {
				  var r = new FileReader();
				r.onload = (function(f) {
					return function(e) {
						var contents = e.target.result;
						var html= "Got the file.</br>" ;
							  html+="Name: " + f.name + "</br>";
							  html+="Type: " + f.type + "</br>";
							  html+="Size: " + f.size + " bytes </br>";
							  //html+="Content starts with: " + contents.substr(1, contents.indexOf("n"));
							  html+="Content starts with: <embed type='"+f.type+"'>" + contents+"</embed>";
						$('#file_read_result').html(html);
					};
				})(f);

				r.readAsText(f);
			}   
		} else {
			  alert("Failed to load files"); 
		}
	}
};


//----------------------------------------------------------------------//
// jQuery AJAX API
//----------------------------------------------------------------------//
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


//-----------------------------------------------------------//
// jQuery AJAX API Promise Handler
//-----------------------------------------------------------//
var Ajax = function(){
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
	this.handler404 = function(){};
	this.handler500 = function(){};
	this.beforeSend = function(){
		//show ajax loader
	};
	
	//return promise
	this.init = function(){
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


//----------------------------------------------------------------------//
// DOM Interaction (Ready/Load, Click, Hover, Change)
//----------------------------------------------------------------------//

var app = new mainApp();// Init mainApp


//var options = {target: document.getElementByTagName('bar_holder'),}
//var nanobar = new Nanobar(options);
var nanobar = new Nanobar(); // Init Nanobar ajax loader


// Document Ready Handler
$(initPage);
function initPage(){		
	nanobar.go(100);//show nanobar	
	
	//-----------------------------------------------//
	// Render HTML Control 
	//-----------------------------------------------//
	app.countCheckedCheckbox();
	//Count Checked Items
	$('input[type="checkbox"][class="rc-checkbox"]').on('click',function(){
		app.countCheckedCheckbox();
		var contolType = $(this).attr('data-controltype');
		if($(this).prop('checked')===true){				
			var html = app.renderControl(contolType);
			$('#control-container').append(html);
		}else{
			$('.control-'+contolType).remove();
		}
	});
}

//-----------------------------------------------//
// Crypto JS Eample
//-----------------------------------------------//
function encryptDecryptTest(){
	var originalValue = $('input[name="originalValue"]').val();
	var secretPhrase = $('input[name="secretPhrase"]').val();		
	encryptedData = CryptoJS.AES.encrypt(originalValue, secretPhrase);
	decryptedData = CryptoJS.AES.decrypt(encryptedData.toString(), secretPhrase);
	
	$("#originalValueStr").html("Original String = "+originalValue);
	$("#secretPhraseStr").html("Secret Phrase = "+secretPhrase);
	$("#encryptedDataStr").html("Encrypted Data = "+encryptedData.toString());
	$("#decryptedDataStr").html("Decrypted Data = "+decryptedData.toString(CryptoJS.enc.Utf8));
}
$("#encryptBtn").on("click",encryptDecryptTest);

//-----------------------------------------------//
//Validate OTP Form
//-----------------------------------------------//
var  otp = app.validOTP;
//Auto move to next textbox
$('.form-control-custom').on('keyup',function(e){
	var len = $(this).val();
	if(len){
		$(this).next('.form-control-custom').focus();
	}			
});

$('#btn-validate-otp').on('click',function(e){
	var pin ='';
	$('.pin').each(function(){
		pin+=$(this).val();
	});
	console.log(pin);
	if(pin != otp){
		alert("Invalid OTP");
		$('.pin').val('');
	}else{
		alert('Successful ! Proceed to next action.');
	}
});



//-----------------------------------------------//
// Render HTML Control 
//-----------------------------------------------//
$(document).on('click','a.remove-control',function(e){
	var domObj = $(this).parents('div[class*="control-"]');
	app.removeDomElement(domObj);		
});


//-----------------------------------------------//
// Read File Content
//-----------------------------------------------//
$('#fileinput').on('change',function(e){	
	app.readMultipleFiles(e);		
});

//-----------------------------------------------//
// String Strength Count
//-----------------------------------------------//
$('#btn-count-strength').on('click',function(e){
	var username = $('#username').val();
	if(username.length>0){
		var strData = app.countStringStrength(username);	
		$('#username_strength').html(JSON.stringify(strData));
	}
	
});

$('#password_strength input[name="password"]').on('keyup',function(e){	
	var strData = app.countStringStrength($(this).val());	
	$('#password_str_strength').html(JSON.stringify(strData));
	$('#str_strength_indicator').html('<button class="btn btn-xs btn-'+strData.strength.css+'">'+strData.strength.displayText+'</button>');
});



//-----------------------------------------------//
// How to use AJAX 
//-----------------------------------------------//
function deleteFile(){
	var xhr = new Ajax();
	xhr.type ='POST';
	xhr.url = SITE_URL+ROUTER_DIRECTORY+ROUTER_CLASS+'/delete_file';
	xhr.data = {id: upload_id, file_path: file_path};
	var promise = xhr.init();	
	
	promise.done(function(data){
		if (data == 'success') {
			data_row.remove();
		}
	});
	promise.done(function(data){
		//do more
	});
	promise.done(function(data){
		//do another task
	});
	promise.fail(function(){
		//show failure message
	});
	promise.always(function(){
		//always will be executed whether success or failue
		//do some thing
	});
	promise.always(function(){
		//do more on complete
	});
}
	
