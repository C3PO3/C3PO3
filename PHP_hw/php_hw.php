<!doctype html>
<html>
    <head>
        <title>php practice</title>
        <link rel="stylesheet" href="style_php.css">
    </head>

    <body>
        <h2>Part 1:</h2>

        <?php
            if(isset($_GET['n'])) {
                $n = intval($_GET['n']);
                if($n > 0) {
                    echo "<h3>Times Table for $n</h3>";
                    echo "<ul>";
                    for($i = 1; $i <= 15; $i++) {
                        echo "<li>$i x $n = " . ($i * $n) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Please provide a positive integer for 'n'.</p>";
                }
            } else {
                echo "<p>Please provide the 'n' parameter in the query string.</p>";
            }
        ?>

        <h2>Part 2:</h2>

        <div class="business_hours">
        <?php
            $hours = array(
                "Monday" => "8am - 3pm",
                "Tuesday" => "8am - 5pm",
                "Wednesday" => "8am - 5pm",
                "Thursday" => "8am - 5pm",
                "Friday" => "8am - 6pm",
                "Saturday" => "10am - 3pm",
                "Sunday" => "Not Open"
            );

            echo "<h3>Business Hours</h3>";
            echo "<ul>";
            foreach ($hours as $day => $hours) {
                echo "<li><strong>$day:</strong> $hours</li>";
            }
            echo "</ul>";
        ?>
        
    </div>

    </body>
</html>