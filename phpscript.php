<?php

// Retrieve the form data using the $_POST superglobal variable
$reviewer = $_POST['reviewer'];
$title = $_POST['title'];
$review = $_POST['review'];

// Connect to your Azure SQL database using the appropriate credentials and database information
$serverName = "priver.database.windows.net";
$connectionOptions = array(
    "Database" => "priver",
    "UID" => "priver",
    "PWD" => "project123@",
    "Encrypt" => true
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check if the connection was successful
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Prepare an SQL INSERT statement to insert the data into your database table
$sql = "INSERT INTO reviews (reviewer, title, review) VALUES (?, ?, ?)";
$params = array($reviewer, $title, $review);
$stmt = sqlsrv_prepare($conn, $sql, $params);

// Execute the SQL statement and check if the insertion was successful
if (sqlsrv_execute($stmt) === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Review submitted successfully!";
}

// Close the database connection
sqlsrv_close($conn);

?>
