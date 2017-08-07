//######################################################################//
//######################### Main Application Object ####################//
//######################################################################//
$.mainApp = {
	validOTP: 1987
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
