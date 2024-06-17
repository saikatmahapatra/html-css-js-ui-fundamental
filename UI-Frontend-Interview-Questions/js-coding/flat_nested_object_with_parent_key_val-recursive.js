/*
Recursive Fn to flat object
*/
let user = {
    name: 'saikat',
    address: {
        home: {
            city: 'kolkata',
            area: 'airport'
        },
        office: {
            city: 'kolkata',
            area: 'newtown',
            landmark: 'near narkel bagan'
        }
    }
}
// output
// user_address_home_area: "airport"
// user_address_home_city: "kolkata"
// user_address_office_area: "newtown"
// user_address_office_city: "kolkata"
// user_address_office_landmark: "near narkel bagan"
// user_name: "saikat"

let finalObj = {};
let flatObj = (obj, parent) => {
    for(let key in obj) {
        if(typeof obj[key] === 'object') {
            flatObj(obj[key], parent + '_' + key); // recursive
        } else {
            finalObj[parent + '_' + key] = obj[key];
        }
    }
}

flatObj(user, 'user');
console.log(finalObj);