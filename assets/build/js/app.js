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
		email: 'ter',
		
	}
};

function emailDummyMask(emailAddress,maskCharacter){
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
}



//######################################################################//
//############### DOM Interaction (Click, Hover, Change) ###############//
//######################################################################//


//***********************************************//
//Document Ready
//***********************************************//
$(document).ready(function(e){
	//var eml = 'saikat.mahapatra@citi.com'
	//var maskedEmail = emailDummyMask(eml,'*');
	//console.log(maskedEmail);
	
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
