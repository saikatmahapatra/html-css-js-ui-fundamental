// factorial

(function factorial(n){
	var res = 1;
	if(n == 0 || n == 1){
		return res;
	} else{
		for(var i = n; i>=1; i--){
			res = res*i;
		}
	}
	console.log(res);
	return res;
})(5);


// using recursive 

function factorial(n){
	var res = 1;
	if(n == 0 || n == 1){
		return res;
	} else{
		return res = res * factorial(n-1);
	}
}
factorial(5);