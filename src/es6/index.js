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

// Singleton Class

class App {
    constructor() {
        if(App._instance) {
            throw new Error(App._instance+ 'App is a singleton class. It cant be instantiate more than once');
        }

        App._instance = this;
    }
    start(){
        console.log('running app')
    }
}

var app1 = new App();
var app2 = new App(); // it will throw 


// Singleton simple syntax using ES6

let person = new class {
    constructor(name) {
        this.name = name;
    }
    getName() {
        return 'name is' + this.name;
    }
}('Saikat Mahapatra');