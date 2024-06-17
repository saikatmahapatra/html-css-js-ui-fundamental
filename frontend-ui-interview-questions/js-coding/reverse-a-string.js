// reverse a string
// input: "I am a JavaScript Developer"
// output: "Developer JavaScript a am I"

let str = 'I am a JavaScript Developer';
(function reverseStr(str){
	let len = str.length;
	let splittedStr = str.split(' ');
	console.log(splittedStr);
	return splittedStr.reverse().join(' '); //Developer JavaScript a am I
})(str);