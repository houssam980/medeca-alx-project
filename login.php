<?php
session_start();
require_once 'db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform login verification
    $query = "SELECT * FROM doctors WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        // Doctor found, retrieve doctor's name
        $doctor = $result->fetch_assoc();
        $_SESSION['doctor_name'] = $doctor['name'];
        header("Location: doctorsdash.php");
        exit();
    } else {
        // Invalid credentials, display error message
        echo '<script>alert("Invalid username or password.");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="post" class="max-w-sm mx-auto p-8 bg-white rounded-lg shadow-lg" style="position: relative;">
        <h1 class="text-3xl font-bold mb-8 text-center">Doctors Login</h1>
        <?php if(isset($error_message)): ?>
            <p class="text-red-500 text-xs mt-1"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="mb-5">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Doctor Username*</label>
            <input type="text" id="username" name="username" class="form-input" required style="border: 1px solid black"/>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password*</label>
            <input type="password" id="password" name="password" class="form-input" required style="border: 1px solid black"/>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Login</button>
    </form>
</body>
</html>
