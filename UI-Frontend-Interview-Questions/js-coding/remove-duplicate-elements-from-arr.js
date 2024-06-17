var arr = [1,1,1,2,3,4,4,4,5,6,7,8,8,8,8,9];
var uniqueArr = [];
uniqueArr = arr.filter(function(item, pos){
    return arr.indexOf(item) == pos;
});

//Using two for and third array
var arr = [1,1,1,2,3,4,4,4,5,6,7,8,8,8,8,9];
var uniqueArr = [], count = 0, foundDuplicateArrElm = false;
for(var i =0; i <= arr.length; i++){
    for(var j = 0; j <= uniqueArr.length; j++){
       if(arr[i] == uniqueArr[j]){
           foundDuplicateArrElm = true;
       }
    }
    count++;
    // for first time 
    if(count == 1 && foundDuplicateArrElm == false){
        uniqueArr.push(arr[i]);
    }
    count = 0;
    foundDuplicateArrElm = false;
}
