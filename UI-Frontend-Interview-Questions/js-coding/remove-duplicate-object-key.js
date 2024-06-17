// remove duplicate entry
//var obj = {a:1, b:2, c:3, d:1};


var myObj = function findDuplicate(obj) {
    //var newObj = {};
    let keys = Object.keys(obj);// a, b, c, d
    let isDuplicate = false;
    for(let i = 0; i<keys.length ; i++) {
        //find duplicate val
        for(let j = i+1; j < keys.length; j++) {
            isDuplicate = false;
            if(obj[keys[i]] === obj[keys[j]]) {
                // this is duplicate
                isDuplicate = true;
                delete obj.keys;
            }
        }
        // if(!isDuplicate) {
        //     newObj[keys[i]] = obj[keys[i]];
        // }
    }
    return obj;
}({a:1, b:2, c:3, d:1});
console.log(myObj);

