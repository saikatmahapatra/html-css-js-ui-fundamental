//ES6
const x = 10;

// Class
class Person {
    constructor(name) {
        //this.name = name;
        this.name(name)
    }
    set name(newName) {
        newName = newName.trim();
        if(newName) {
            this.name = newName;
        } else {
            throw 'Name can not empty';
        }
    }
    get name() {
        return this.name;
    }
}
let saikat = new Person('saikat mahapatra');
console.log(saikat.name);