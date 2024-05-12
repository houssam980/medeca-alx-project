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
    $request_id = isset($_POST['request_id']) ? intval($_POST['request_id']) : 0;
    $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, $_POST['message']) : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    // SQL to insert data into table
    $sql = "INSERT INTO docsanswers (request_id, message, date) 
            VALUES ('$request_id', '$message', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo '<script language="javascript">';
        echo 'alert("Answer submitted successfully")';
        echo '</script>';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted Successfully</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Concert+One&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lilita+One&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Jost", sans-serif;
    font-optical-sizing: auto;
    font-weight: weight;
    font-style: normal;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 90%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        button {
            background-color: #00ff14;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.7s;
        }

        button:hover {
            background-color: #15c79e;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Answer Has been Sent</p>
        <button onclick="window.location.href = 'doctorsdash.php';" >Back to Previous Page</button>
    </div>
</body>
</html>
