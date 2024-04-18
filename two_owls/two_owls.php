
<html>
    <head>
        <title>Order Display</title>
        <link rel="stylesheet" href="owls.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){      
                $("#orderForm").submit(function(event) {
                    var itemCount = $("select[name$='_quantity']").filter(function() {
                        return $(this).val() > 0;
                    }).length;
                    var firstName = $("#firstName").val();
                    var lastName = $("#lastName").val();

                    // Validate at least one item is ordered
                    if (itemCount === 0) {
                        alert("Please order at least one item.");
                        event.preventDefault();
                        return;
                    }

                    // Validate customer's first and last names
                    if (firstName === "" || lastName === "") {
                        alert("Please provide your first and last names.");
                        event.preventDefault();
                        return;
                    }

                    // Add hidden fields for item details
                    $("select[name$='_quantity']").each(function() {
                            var itemName = $(this).attr("name").replace("_quantity", "");
                            var quantity = $(this).val();
                            $("<input>").attr("type", "hidden").attr("name", itemName).val(quantity).appendTo("#orderForm");
                    });

                    // Add hidden fields for item count and user details
                    $("<input>").attr("type", "hidden").attr("name", "itemCount").val(itemCount).appendTo("#orderForm");
                    $("<input>").attr("type", "hidden").attr("name", "firstName").val(firstName).appendTo("#orderForm");
                    $("<input>").attr("type", "hidden").attr("name", "lastName").val(lastName).appendTo("#orderForm");

                    // Retrieve pickup time and add it to the form
                    var now = new Date();
                    // Adding 20 minutes to current time
                    now.setMinutes(now.getMinutes() + 20);
                    var pickupTime = now.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                    $("<input>").attr("type", "hidden").attr("name", "pickupTime").val(pickupTime).appendTo("#orderForm");
                });
            });
        </script>
    </head>
</html>

<?php
    include 'header_owl.php';

    echo "<h3>Menu:</h3>";
    $servername = "localhost";
    $username = "u5rikrp6bcxpf";
    $password = "passtest2233";
    $dbname = "db3kh2s604dztx";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch menu items from the database
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    // start form element here
    echo '<form method="get" action="process_order.php" id = "orderForm">';

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<p>Name: " . $row["name"] . "</p>";
            echo "<p>Description: " . $row["description"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            echo '<img src="' . $row["image_name"] . '" alt="' . $row["name"] . '" style="width: 300px;"><br>';
            echo '<label for="' . $row["name"] . '">Quantity:</label>';
            echo '<select id="' . $row["name"] . '" name="' . $row["name"] . '_quantity">';
            for ($i = 0; $i <= 10; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            echo '</select><br><br>';
        }
    } else {
        echo "0 results";
    }
    // end form element here
    echo '<label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName"><br><br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName"><br><br>
        <label for="specialInstructions">Special Instructions:</label><br>
        <textarea id="specialInstructions" name="specialInstructions" rows="4" cols="50"></textarea><br><br>
        <input type="hidden" id="pickupTime" name="pickupTime" value="">

        <input type="submit" value="Submit Order">
    </form>';

    $conn->close();
?>
