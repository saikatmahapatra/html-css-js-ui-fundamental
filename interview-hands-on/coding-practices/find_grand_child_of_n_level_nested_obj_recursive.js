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
};

//name of children will be [child_1, grand_child_1, child_2...]

let nameOfChildren = [];
let findChild = (obj) => {
    for(let key in obj) {
        //console.log('key => ' + key);
        if(key === 'children') {
            if(obj[key].length > 0) {
                for(let i = 0; i <= obj[key].length ; i++) {
                    findChild(obj[key][i]);
                }
            }
        } 
        if(key === 'name') {
            nameOfChildren.push(obj[key]);
        }
    }
}

findChild(person);
console.log(nameOfChildren);