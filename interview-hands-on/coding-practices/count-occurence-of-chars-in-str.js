(function(str){
    var arr = str.split('');
    arr.sort();
    var charCount = {};
	var arr = str.toLowerCase().split('');
	for(var i = 0 ; i < arr.length; i++){
		if(charCount[arr[i]]) {
			charCount[arr[i]] = charCount[arr[i]]+1;
		} else{
			charCount[arr[i]] = 1;
		}
	}
	console.log(JSON.stringify(charCount));
})('aaaabbccccdefggghiij');
// {"a":8,"b":2,"c":8,"d":1,"e":1,"f":1,"g":4,"h":1,"i":2,"j":1}