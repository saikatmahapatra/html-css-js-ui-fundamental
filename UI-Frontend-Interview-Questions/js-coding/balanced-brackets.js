/*Balanced Brackets

Write a function that takes a string made up of brackets (, [, {, ), }, ] and other optional characters.
The function should return a boolean representing whether the string is balanced with regards to brackets.

A string is said to be balanced if it has an many opening brackets of a certain type as it has closing brackets of that type and if no bracket is unmatched. Note that an opening bracket can’t match a corresponding closing bracket that comes before it, and similarly a closing bracket can’t match a corresponding opening bracket that comes after it. Also, brackets can’t overlap each other as in [(]).

Sample input => "([])(){}(())()()"

( --> )*/



var str = 's(a(ika)t';
var bracket = {
	'(' : ')',
	'{' : '}',
	'[' : ']',
};

var res = [];
for(let i = 0; i<str.length; i++) {
	var char = str[i];
	if(bracket[char]) {
		// found opening tag
		res.push(bracket[char]);		
	}

}

