function findPrimeFactorsTo(min, max) {
	let flag = 0;
	let primeNumbers = [];
	for(var i = min; i <= max; i++){
		flag = 0;
		for(var j = 2; j < i; j++){
			if(i % j === 0){
				flag = 1;
				break;
			}
		}
		if(i > 1 && flag === 0) {
			console.log(i);
			primeNumbers.push(i);
		}
	}
	return primeNumbers;
}

findPrimeFactorsTo(0, 100);
