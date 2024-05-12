<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve data from form and sanitize inputs
    $first_name = isset($_POST['floating_first_name']) ? mysqli_real_escape_string($conn, $_POST['floating_first_name']) : '';
    $last_name = isset($_POST['floating_last_name']) ? mysqli_real_escape_string($conn, $_POST['floating_last_name']) : '';
    $phone = isset($_POST['floating_phone']) ? mysqli_real_escape_string($conn, $_POST['floating_phone']) : '';

    // SQL to insert data into table
    $sql = "INSERT INTO requests (first_name, last_name, phone) 
            VALUES ('$first_name', '$last_name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page to avoid resubmission
        header("Location: success.php");
        exit(); // Make sure to terminate the script after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // If the form is not submitted, display an error message
    echo "Form not submitted!";
}
?>
