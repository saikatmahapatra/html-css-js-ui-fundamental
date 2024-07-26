const isPalinndrome = ["sunday", "dad", "civic", "php", "java", "madam", "radar", "deified", "kayak", "level", "mom", "noon", "wow", 1881, 76769, 1234, 121, 202, 5455];

(function checkPalindrome(isPalinndrome) {
    isPalinndrome.forEach((word) => {
        const str = word.toString();
        const reverseStr = str.split('').reverse().join('');
        if (str === reverseStr) {
            console.log(`${str} --- is a palindrome`);
        } else {
            console.log(`${str} --- is not palindrome`);
        }
    });
})(isPalinndrome);