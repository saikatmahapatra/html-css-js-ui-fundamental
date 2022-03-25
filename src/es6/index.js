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

//Inheritance -prototypal
function Animal(name){
    this.name = name;
}
var cat = new Animal('cat');
Animal.prototype.eatingHabit = function(eat) {
    console.log(this.name + ' can eat '+eat)
}
cat.eatingHabit('milk');

var dog = new Animal('Dog');
dog.eatingHabit('meat');

//ES6 inheritance using extends, super

class Animal {
    constructor(name) {
        this.name = name;
    }
    getName() {
        console.log('name of the animal is '+this.name);
    }
}

class Cat extends Animal {
   
    constructor(name) {
        super(name); 
        // if we dont call super(), we will get Uncaught ReferenceError: 
        // Must call super constructor in derived class before accessing 'this' or returning from 
        // derived constructor
        this.color = 'red';
    }

    

    eatingHabit() {
        console.log('Name of cat '+this.color);
    }
}

let redCat = new Cat('red Cat');
this.color = 'black';
redCat.getName();
redCat.eatingHabit();
