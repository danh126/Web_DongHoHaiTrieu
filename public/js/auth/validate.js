//Function Validate Email
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

//Validate Length
function checkLength(input, minLength, maxLength) {
    var length = input.length;

    if (length < minLength) {
        return false;
    } else if (length > maxLength) {
        return false;
    } else {
        return true;
    }
}

//Validate Number
function isNumber(value) {
    return /^-?\d+(\.\d+)?$/.test(value);
}