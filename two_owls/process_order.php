<head>
    <link rel="stylesheet" href="owls.css">
</head>

<?php
    echo "<h1>Order Details</h1>";
    $pickupTime = $_GET["pickupTime"];
    // Parse the pickupTime string into a DateTime object
    $dateTime = new DateTime($pickupTime);

    // Format the DateTime object
    $formattedPickupTime = $dateTime->format('F d, Y h:i A');

    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $specialNotes = $_GET["specialInstructions"];

    // Display name and special notes
    echo "<p><strong>User's Name:</strong> $firstName $lastName</p>";
    echo "<p><strong>Special Notes:</strong> $specialNotes</p>";

    // Display ordered items
    echo "<h2>Ordered Items</h2>";
    $subtotal = 0;
    $taxRate = 0.0625; // 6.25%
    $total = 0;

    $servername = "localhost";
    $username = "u5rikrp6bcxpf";
    $password = "passtest2233";
    $dbname = "db3kh2s604dztx";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    foreach ($_GET as $key => $value) {
        if (strpos($key, '_quantity') !== false && $value > 0) {
            // Extract item name from the key
            $itemName = str_replace('_quantity', '', $key);
            $itemName = str_replace("_", " ", $itemName);

            $sql = "SELECT price FROM menu WHERE name = '$itemName';";
            $itemPrice = $conn->query($sql);

            if ($itemPrice->num_rows == 1) {
                $row = mysqli_fetch_array($itemPrice);
                $itemPrice = $row[0];
            }
            // shouldn't ever happen(database issue)
            else {
                echo "ERROR MORE THAN ONE PRICE";
            }

            $itemTotal = $itemPrice * $value;
            $subtotal += $itemTotal;
            // Display item details
            echo "<p><strong>$itemName</strong></p>";
            echo "<p>Quantity: $value</p>";
            echo "<p>Price: $" . number_format((float)$itemPrice, 2, '.', '') . "</p>";
            echo "<p>Total for Item: $" . number_format((float)$itemTotal, 2, '.', '') . "</p>";
            echo "<hr>";
        }
    }

    // Calculate tax and total
    $tax = $subtotal * $taxRate;
    $total = $subtotal + $tax;

    // Display subtotal, tax, and total
    echo "<h2>Order Summary</h2>";
    echo "<p><strong>Subtotal:</strong> $" . number_format($subtotal, 2) . "</p>";
    echo "<p><strong>Tax (6.25%):</strong> $" . number_format($tax, 2) . "</p>";
    echo "<p><strong>Total:</strong> $" . number_format($total, 2) . "</p>";

    // Display pickup time
    echo "<h2>Pickup Time</h2>";
    echo "<p><strong>Pickup Time:</strong> $formattedPickupTime</p>";
?>
