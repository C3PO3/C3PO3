// Create a second version of the assignment as follows

// Use an associative array for the item names and prices
var menu = {
    hotdogs: 4.65,
    fries: 3.75,
    drinks: 1.89
};

// Use a second associative array for the item names and quantities
var orders = {
    hotdogs: 0,
    fries: 0,
    drinks: 0
};

// Use a loop to get the quantities from the user
for (item in menu) {
    orders[item] = prompt("How many orders of " + item + " do you want?", 0);
}

// copied show money function from original joes code
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

// Use a loop to do the subtotal calculation
var total_cost = 0;
for (item in menu) {
    total_cost += menu[item] * orders[item];
}
document.write("<b>subtotal before discount:</b> $" + showMoney(total_cost) + "<br>");

/**********************************************************************************
 * COPIED FROM THE ORIGINAL JOES CODE SINCE THERE WERE NO ADDITIONAL INSTRUCTIONS *
 **********************************************************************************/

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


