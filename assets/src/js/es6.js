//  #####################################
//  ES6
//  #####################################
const x = 10;


// ####################################################
// Class
// ####################################################
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
var saikat = new Person('saikat mahapatra');
console.log(saikat.name);

// ####################################################
// Singleton Class
// ####################################################

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



// ####################################################
// Singleton simple syntax using ES6
// ####################################################

let person = new class {
    constructor(name) {
        this.name = name;
    }
    getName() {
        return 'name is' + this.name;
    }
}('Saikat Mahapatra');

// ####################################################
// Inheritance -prototypal
// ####################################################
function Animals(name){
    this.name = name;
}
var cat = new Animals('cat');
Animals.prototype.eatingHabit = function(eat) {
    console.log(this.name + ' can eat '+eat)
}
cat.eatingHabit('milk');

var dog = new Animals('Dog');
dog.eatingHabit('meat');


// ####################################################
//  Classical Inheritance/ES6 inheritance using extends, super
// ####################################################
class Animal {
    constructor(name) {
        this.name = name;
    }
    getName() {
        console.log('parent getName(). name => '+ this.name);
    }

    static helloworld() {
        console.log('Hello World');
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

    // method shadowing: child can have same method as parent. In that case parent method get shadowed. This is known as
    // method shadowing
    // to call parent's method we need to use super.methodName();
    getName() {
        super.getName();
        console.log('child getName(). name => '+ this.name);
    }
    

    eatingHabit() {
        console.log('Name of cat '+this.color);
    }
}

let redCat = new Cat('red Cat');
this.color = 'black';
redCat.getName();
redCat.eatingHabit();
// redCat.helloworld(); // Accessing static method will throw Error: Uncaught TypeError: redCat.helloworld is not a function
Cat.helloworld(); // works
Animal.helloworld(); // works


// ####################################################
// use new.target to know whether a function was called using new keyword or like a normal function
// for normal function call new.target will be undefined
// for new keyword function call new.target will return a reference to that function
// ####################################################
// function User(name) {
//     if(!new.target) {
//         throw Error('You need to use new User() syntax');
//     }
//     this.fullName = name;
// }
// // window object will not have fullName
// var saikat = new User('Saikat Mahapatra'); 

// // window.fullName = 'John Smith' as this is a global
// User('John Smith');


class User{
    constructor(name) {
        this.fullName = name;
        console.log(new.target);
    }
}

class Emp extends User {
    constructor(name, title) {
        super(name);
        this.role = title;
    }
}

let sm = new User('saikat mahapatra'); // [Function: User]
let js = new Emp('John Smith', 'Software Engineer'); //[Function: Emp]


// ####################################################
//  Arrow Function in ES6
// ####################################################

// Normal function expression
let add = function(a, b) {
    return a+b;
}

// Arrow function
add = (a, b) => a+b // simple form of arrow function

add = (a, b, c, d) => {
    retun (a+b)*(c+d)
}
