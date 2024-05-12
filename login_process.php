<?php
require_once 'db.php';





if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize and validate input data (you should use prepared statements to prevent SQL injection)

    // Example query (replace with your actual query logic)
    $query = "SELECT * FROM users WHERE email = '$email'"; // Assuming 'email' is the column name in your users table

    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        // User found, check if password matches
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Direct comparison
            // Password is correct, proceed with login
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            // Redirect to user profile page
            header("Location: userprofile.php");
            exit();
        } else {
            // Password is incorrect
            echo '<script>alert("Incorrect password. Please try again.");</script>';
        }
    } else {
        // User not found, redirect to sign up page
        header("Location: signupform.php");
       
        exit();
    }
} else {
    // Handle cases where the form data is not set
    echo '<script>alert("Form data is not set.");</script>';
}
?>
