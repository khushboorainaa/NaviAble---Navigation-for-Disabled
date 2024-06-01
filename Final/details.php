<!-- details.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* Add your styling for the results page here */
    </style>
</head>

<body>
    <h1>Search Results</h1>

    <div id="search-results">
        <?php
        include("connection.php");
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "SELECT * FROM places WHERE state = '$state'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>Place Name:</strong> " . $row["place_name"] . "</p>";
                    echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
                    echo "<p><strong>City:</strong> " . $row["city"] . "</p>";
                    echo "<p><strong>State:</strong> " . $row["state"] . "</p><br>";
                }
            } else {
                echo "<p>No results found</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>

</html>
