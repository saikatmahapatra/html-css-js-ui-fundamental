/*
https://www.codewars.com/kata/54bf1c2cd5b56cc47f0007a1/train/javascript
Count the number of Duplicates
Write a function that will return the count of distinct case-insensitive alphabetic characters and numeric digits that occur more than once in the input string. The input string can be assumed to contain only alphabets (both uppercase and lowercase) and numeric digits.

Example
"abcde" -> 0 # no characters repeats more than once
"aabbcde" -> 2 # 'a' and 'b'
"aabBcde" -> 2 # 'a' occurs twice and 'b' twice (`b` and `B`)
"indivisibility" -> 1 # 'i' occurs six times --- failed
"Indivisibilities" -> 2 # 'i' occurs seven times and 's' occurs twice  -- failed
"aA11" -> 2 # 'a' and '1'
"ABBA" -> 2 # 'A' and 'B' each occur twice
*/



function duplicateCount(text){
  var count = 0;
  var currentElm = null;
  if(text) {
    var arr = text.toLowerCase().split('');
    //arr.sort();
    console.log(arr);
    for(var i = 0; i<arr.length; i++){
      if(arr[i] != currentElm) {
        currentElm = arr[i];
        //count = 0;
      } else {
        count++;
      }      
    }
  }
  return count;
}