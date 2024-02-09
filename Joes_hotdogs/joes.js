
// global declaration
const dog_price = 4.65;
const fries_price = 3.75;
const drink_price = 1.89;

var numDogs = prompt("How many hot dogs do you want?", 0);

var numFries = prompt("How many orders of fries do you want?", 0);

var numSoda = prompt("How many drinks do you want?", 0);

// takes a floating point number as a parameter
// and returns a string that shows the number rounded to exactly 2 places
function showMoney(val) {
    val_new = Math.round(val * 100);
    val_new /= 100;
    // now val has max 3 places and has been rounded
    str = "" + val_new;
    // then needs an extra 0 at the end of the string
    if (((val_new * 100) % 10) == 0) {
        str += "0";
    }
    return str
}

// subtotal for order. Store in a variable
total_cost = (numSoda * drink_price) + (numDogs * dog_price) + (numFries * fries_price);

document.write("subtotal before discount: $" + showMoney(total_cost) + "<br>");

// 10% discount if the order (before tax) is at least $25
discount = total_cost * 0.1;
if (total_cost >= 25) {
    // reround in case the discount made the places not line up
    total_cost -= discount;
    document.write("discount: $" + showMoney(discount) + "<br>");
}
document.write("subtotal after discount: $" + showMoney(total_cost) + "<br>");

// Add 6.25% Massachusetts meals tax to the new subtotal
// This is the final amount the customer will need to pay.
tax = total_cost * 0.0625;
document.write("tax amount: $" + showMoney(tax) + "<br>");

total_cost = total_cost + tax;
document.write("final total: $" + showMoney(total_cost));
