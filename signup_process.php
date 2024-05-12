<?php
// Include the database configuration file
include 'db.php';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare an SQL statement to insert the data into the users table
    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful.');</script>";
    } else {
        echo "<script>alert('Error: please check your info." . $mysqli->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
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
        <h1>Thank You!</h1>
        <p>Registration Completed</p>
        <button onclick="window.location.href = 'signinform.php';" >Go To login</button>
    </div>
</body>
</html>
