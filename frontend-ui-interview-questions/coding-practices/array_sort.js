function sortArr(arr){
    for(var i = 0; i < arr.length; i++) {
        var temp = arr[i];
        for(var j = i-1 ; j>=0 && (arr[j] < temp); j-- ){
            arr[j+1] = arr[j];            
        }
        console.log('temp ='+temp);
        arr[j+1] = temp;
    }
    return arr;
}

var arr = [1,1,0,0,8,1,0,1,1,0,1,0,1, 8, 8];
console.log(sortArr(arr));