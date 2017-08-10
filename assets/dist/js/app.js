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

//######################################################################//
//######################### Main Application Object ####################//
//######################################################################//

$.mainApp = {
	validOTP: 1987,
	countCheckedCheckbox: function(){
		var c = $('input[type="checkbox"][class="rc-checkbox"]:checked').length;
		$('#cb_counter').html(c);
	},
	renderControl: function(type){
		switch(type){
			case 'textbox':
				var html = '<div class="form-group control-'+type+'" data-controltype="'+type+'">';
				html+='<div class="col-md-8">';
				html+='<input type="text" name="demoname[]" class="form-control" placeholder="Enter text here"/>';					
				html+='</div>';
				html+='<div class="">';
				html+='<a href="#" class="remove-control">Remove</a>';
				
				html+='</div>';
				html+='</div>';
				return html;
				break;
			default:
				return '<div class="alert alert-danger">No data-controltype attribute found in the selected checkbox</div>';
		}
	},
	removeDomObj: function(obj){
		$(obj).remove();
	},
	countControl: function(type){
		var c = $('div.control-'+type).length;
	},
	regEx: {
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
		
	},
	maskAll: function(){},
	digitMask: function(){},
	emailMask: function(emailAddress,maskCharacter){
		var email = emailAddress;
		var maskedPart = '';	
		var maskChar = maskCharacter;
		var emailSplit = email.split('@');
		var emailAddressLegth = emailSplit[0].length;
		var maskedEmailAddress = maskedPart+'@'+emailSplit[1];
		if(emailAddressLegth<=3){		
			var emailArr = emailSplit[0].split("");
			for(i=0; i<emailAddressLegth; i++){
				if(i != 0){
					emailArr[i] = maskChar;
				}
			}
			maskedPart = emailArr.join("");
			maskedEmailAddress = maskedPart+'@'+emailSplit[1];		
		}
		else{		
			var emailArr = emailSplit[0].split("");
			for(i=0; i<emailAddressLegth; i++){
				if(i != 0 && i != (emailAddressLegth-1)){
					emailArr[i] = maskChar;
				}
			}
			maskedPart = emailArr.join("");
			maskedEmailAddress = maskedPart+'@'+emailSplit[1];
		}	
		return {"email":email,"masked":maskedEmailAddress};
	},
	readMultipleFiles: function(evt) {
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
	},
	countStringStrength: function(str){			
		var i = 0;
		var total_strength = 0;
		var strWeight = {
			string:str,
			length:str.length,
			upper: {count: 0,weight:0},
			lower: {count: 0,weight:0},
			numeric: {count: 0,weight:0},
			special: {count: 0,weight:0},
		}
		while(i<str.length){
			var strChar = str.charAt(i);
			i++;
			if ($.mainApp.regEx.alpha_upper.test(strChar)) {
			 strWeight.upper.count++;
			 strWeight.upper.weight++;
			}
			else if ($.mainApp.regEx.alpha_lower.test(strChar)){
			 strWeight.lower.count++;
			 strWeight.lower.weight++;
			}
			else if ($.mainApp.regEx.numeric_only.test(strChar)){
			 strWeight.numeric.count++;
			 strWeight.numeric.weight++;
			}
			else if ($.mainApp.regEx.is_special_char.test(strChar)){
			 strWeight.special.count++;
			 strWeight.special.weight++;
			}			
		}				
		return strWeight;		
	}
  
};



//######################################################################//
//########################### jQuery AJAX API ##########################//
//######################################################################//
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




//######################################################################//
//######## DOM Interaction (Ready/Load, Click, Hover, Change) ##########//
//######################################################################//

//***********************************************//
// Initiate Nanobar 
//***********************************************//
//var options = {target: document.getElementByTagName('bar_holder'),}
//var nanobar = new Nanobar(options);
var nanobar = new Nanobar();


//***********************************************//
//Document Ready
//***********************************************//
$(document).ready(function(e){
	//var eml = 'saikat.mahapatra@citi.com'
	//var maskedEmail = emailDummyMask(eml,'*');
	//console.log(maskedEmail);
	nanobar.go(100);
	
	//***********************************************//
	// Render HTML Control 
	//***********************************************//
	$.mainApp.countCheckedCheckbox();
	//Count Checked Items
	$('input[type="checkbox"][class="rc-checkbox"]').on('click',function(){
		$.mainApp.countCheckedCheckbox();
		var contolType = $(this).attr('data-controltype');
		if($(this).prop('checked')===true){				
			var html = $.mainApp.renderControl(contolType);
			$('#control-container').append(html);
		}else{
			$('.control-'+contolType).remove();
		}
	});
	
});


//***********************************************//
//Crypto JS Encryption
//***********************************************//
$("#encryptBtn").on("click",function(){
	var originalValue = $('input[name="originalValue"]').val();
	var secretPhrase = $('input[name="secretPhrase"]').val();		
	encryptedData = CryptoJS.AES.encrypt(originalValue, secretPhrase);
	decryptedData = CryptoJS.AES.decrypt(encryptedData.toString(), secretPhrase);
	
	$("#originalValueStr").html("Original String = "+originalValue);
	$("#secretPhraseStr").html("Secret Phrase = "+secretPhrase);
	$("#encryptedDataStr").html("Encrypted Data = "+encryptedData.toString());
	$("#decryptedDataStr").html("Decrypted Data = "+decryptedData.toString(CryptoJS.enc.Utf8));
});

//***********************************************//
//Validate OTP Form
//***********************************************//
var  otp = $.mainApp.validOTP;
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



//***********************************************//
// Render HTML Control 
//***********************************************//
$(document).on('click','a.remove-control',function(e){
	var domObj = $(this).parents('div[class*="control-"]');
	$.mainApp.removeDomObj(domObj);		
});


//***********************************************//
// Read File Content
//***********************************************//
$('#fileinput').on('change',function(e){	
	$.mainApp.readMultipleFiles(e);		
});

//***********************************************//
// Read File Content
//***********************************************//
$('#btn-count-strength').on('click',function(e){
	var username = $('#username').val();
	if(username.length>0){
		var username_weight = $.mainApp.countStringStrength(username);	
		$('#username_weight').html(JSON.stringify(username_weight));
	}
	
});
