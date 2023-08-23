/*Given an array of size N-1 such that it only contains distinct integers in the range of 1 to N. Find the missing element.
[1,3,4,5]*/



function getElm(arr){
	let length = arr.length;
	let total = Math.floor((length + 1) * (length+2)/2);
	for(let i = 0; i< length; i++){
		console.log(arr[i]);
		total -= arr[i];
	}
	return total;
	console.log('res=>', total);
}

getElm([1,3,4,5]);



function getElm(arr){
	let length = arr.length;
	let total = Math.floor((length + 1) * (length+2)/2);
	for(let i = 0; i< length; i++){
		console.log(arr[i]);
		total -= arr[i];
	}
console.log('res=>', total);

	return total;
	
}

getElm([6,1,2,8,3,4,7,10,5]);
