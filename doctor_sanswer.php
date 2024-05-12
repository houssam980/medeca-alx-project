<?php
// Include the database configuration file
include_once 'db.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: signinform.php");
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $mysqli->query($query);

// Check if query executed successfully
if (!$result) {
    // Display error message if query fails
    echo "Error fetching user data";
    exit(); // Stop script execution
}

// Fetch user data
$user = $result->fetch_assoc();

// Close the result set
$result->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="user.css">
    <style>
        /* Custom CSS */
        .dashboard {
            display: flex;
        }

        .sidebar {
            width: 25%;
            background-color: #4a5568;
            color: #ffffff;
            padding: 20px;
        }

        .main-content {
            width: 75%;
            padding: 20px;
        }

        .answer {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .answer h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .answer p {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
        <h1 style="font-size: 20px;">Medeca Users</h1>
            <br>
            <ul>
                <li><a href="userprofile.php"><b>Home</b></a></li>
                <li><a href="requastacons.php"><b>Request A consultation</b></a></li>
                <li><a href="doctor_sanswer.php"><b>Doctors Answers</b></a></li>
                <br><br>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <h2 class="text-2xl font-semibold mb-4">Doctors Answers</h2>
                <?php
                // Fetch answers from the database
                $query = "SELECT * FROM docsanswers";
                $result = $mysqli->query($query);

                // Check if there are answers
                if ($result && $result->num_rows > 0) {
                    // Loop through each answer and display it
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='answer'>";
                        echo "<p>{$row['message']}</p>";
                        echo "<p>Date: {$row['date']}</p>";
                        echo "</div>";
                    }
                } else {
                    // Display a message if there are no answers
                    echo "<p>No answers available Yet</p>";
                }

                // Close the result set
                $result->close();

                // Close the database connection
                $mysqli->close();
                ?>
            </div>
            <a href="signout.php" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" style="float: right; margin-top: -38px;">Logout</a>
        </div>
    </div>
    
</body>

</html>
