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



let user = {
    name: 'saikat',
    address: {
        home: {
            city: 'kolkata',
            area: 'airport'
        },
        office: {
            city: 'kolkata',
            area: 'newtown'
        }
    }
}

// user_address_home_area: "airport"
// user_address_home_city: "kolkata"
// user_address_office_area: "newtown"
// user_address_office_city: "kolkata"
// user_name: "saikat"

let finalObj = {};
let flatObj = (obj, parent) => {
    for(let key in obj) {
        if(typeof obj[key] === 'object') {
            flatObj(obj[key], parent + '_' + key)
        } else {
            finalObj[parent + '_' + key] = obj[key];
        }
    }
}

flatObj(user, 'user');
console.log(finalObj);



let students = [{name: 'saikat', marks: 80}, {name: 'john', marks: 90}, {name: 'mohan', marks: 86}];
// find the topper's name

function findTopper(students) {
    var maxScore;
    var topper = [];
    for(var i = 0; i < students.length; i++) {
        for(var j = i; j < i-1; j++) {
            if(students[i].marks > students[j].marks) {
                maxScore = students[i].marks;
            }
        }
    }
    return maxScore;
}