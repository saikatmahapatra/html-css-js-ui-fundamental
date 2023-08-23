/*Validate Subsequence
Given two non-empty arrays of integers, write a function that determines whether the second array is a subsequence of the first one.
A subsequence of an array is a set of numbers that aren’t necessarily adjacent in the array but that are in the same order as they appear in the array.
For instance, the numbers [1,3,4] form a subsequence of the array [1, 2, 3, 4], and so do the numbers [2, 4].
Note that a single number in a array itself are both valid subsequences of the array*/



let array = [5, 1, 22, 25, 6, -1, 8, 10];
let sequence = [1, 6, -1, 10];

function checkSeq(arr, seq){
	let counter = 0;
	for(let i = 0; i <arr.length; i++) {
		// increment counter if current num of main array is equal to seq's index
		let n = arr[i]
		if(n == seq[counter]) {
			counter++;
		}
		if(counter == seq.length) {
			return true;
		}		
	}
	return false;
}

checkSeq(array, sequence);