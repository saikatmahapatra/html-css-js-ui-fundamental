var fruits = [
    {name:'mango', price: 80.00}, 
    {name:'banana', price: 10.00}, 
    {name:'lemon', price: 27.50}, 
    {name:'orange', price: 45.00}
];
var res = fruits.filter(function(el, index, arr){
return el.price>30 && el.price<50;
});
console.log(res);

// Find min, max using ES6

function findMaxPrice(fruits) {
    var maxPrice = 0, itemName = '';
    for(const {name, price} of fruits) {
        if(price > maxPrice) {
            maxPrice = price;
            itemName = name;
        }
    }
    console.log(maxPrice, itemName);
}
findMaxPrice(fruits);
