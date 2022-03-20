//ES6
const x = 10;

// Class
class Person {
    constructor(name) {
        this.name = name;
    }
    getName() {
        return this.name;
    }
}
let saikat = new Person('saikat mahapatra');
console.log(saikat.getName());