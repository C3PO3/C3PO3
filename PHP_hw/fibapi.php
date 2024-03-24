
<?php
    if(isset($_GET['n'])) {
        $n = intval($_GET['n']);
        if($n > 0) {
            $fibonacci = array();
            $fibonacci[0] = 0;
            $fibonacci[1] = 1;
            for ($i = 2; $i < $n; $i++) {
                $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
            }

            $response = array("data" => $fibonacci);
            echo json_encode($response);

        } else {
            echo "<p>Please provide a positive integer for 'n'.</p>";
        }
    } else {
        echo "<p>Please provide the 'n' parameter in the query string.</p>";
    }
?>