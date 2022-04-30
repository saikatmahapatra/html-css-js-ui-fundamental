//Sort the array [1,1,0,0,1,0,1,1,0,1,0,1] 
//output: [1,1,1,1,1,1,1,0,0,0,0,0]

const e = require("express");


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



// person 


var person = {
	name: 'root', 
	children:[{
		    name: 'child_1', 
		    children:[{ 
				name: "grand_child_1", 
				children:[] 
		    		}]
		},
		{
		    name: 'child_2', children:[]
		}]
	}

    function findChildren(obj){
        var children = [];
        if(obj.children.length == 1) {
            children.push(obj.children?.name);
        } else {
            for(var i = 0 ; i<= obj.children.length; i++) {
                if(obj.children[i].children){
                    findChildren(obj.children[i].children);
                } else {
                    children.push(obj.children[i].name);
                }
            }
        }
        return children;
    }

// Output: [child_1, grand_child_1, child_2]

function Animal(n) {
    console.log(this);
    this.name = n;
    this.getName = function(){
        console.log('name is '+ this.name);
    }
    console.log('after', this);
}
var cat = new Animal('cat');
cat.getName();