<?php
// Check if the request ID is provided
if (isset($_POST['request_id'])) {
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "medeca_db"; // Your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the request ID
    $request_id = $_POST['request_id'];

    // Construct the SQL query to delete the request
    $sql = "DELETE FROM requests WHERE id = $request_id";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the doctor's page after deletion
        header("Location: doctorsdash.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request ID is not provided, redirect back to the doctor's page
    header("Location: doctorsdash.php");
    exit();
}
?>
