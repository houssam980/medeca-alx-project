<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,337;1,337&display=swap');
body {

    font-family: "Josefin Sans", sans-serif;
  font-optical-sizing: auto;
  font-weight: 337;
  font-style: normal;
  font-size: 18px;
        }

button {
    margin: 10px;
    padding: 10px;
}

#btn-asr {
    color: white;
    background-color: #4ac54a;
    border-radius: 10px;
}


#btn-del {
    color: white;
    background-color: #df2d2d;
    border-radius: 10px;
}
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 bg-blue-500 p-6 text-white">
            <h2 class="text-2xl font-semibold mb-4">Medeca Doctors Dashboard</h2>
        </div>
        <!-- Main Content -->
        <div class="w-3/4 p-8">
            <!-- Patients Consultation Requests -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold mb-4">Patients Consultation Requests</h1>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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

                            // Fetch consultation requests from the database
                            $sql = "SELECT * FROM requests";
                            $result = $conn->query($sql);

                            // Display consultation requests
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='border px-4 py-2'>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["phone"] . "</td>";
                                    echo "<td class='border px-4 py-2'>
                                            <form action='delete_request.php' method='post' class='inline'>
                                                <input type='hidden' name='request_id' value='" . $row["id"] . "'>
                                                <button type='submit' id ='btn-del' class='text-red-600'>Delete</button>
                                            </form>
                                            <button onclick='answerRequest(" . $row["id"] . ")' class='text-blue-600 ml-2' id = 'btn-asr'>Answer</button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='border px-4 py-2 text-center'>No consultation requests</td></tr>";
                            }

                            // Close connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
          <br>
          <br>
          <br>
          <hr>
          <br>
          <br>
          <br>
             <!-- Users -->
             <div class="container mx-auto py-8">
                <h1 class="text-2xl font-semibold mb-4">Patients Using Platform</h1>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">First Name</th>
                                <th class="px-4 py-2">Last Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Created At</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to your MySQL database for fetching users
                            $servername = "localhost";
                            $username = "root"; // Your MySQL username
                            $password = ""; // Your MySQL password
                            $dbname = "medeca_db"; // Your MySQL database name
                            $userConn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($userConn->connect_error) {
                                die("Connection failed: " . $userConn->connect_error);
                            }

                            // Check if delete button is clicked
                            if (isset($_POST['delete_user'])) {
                                $deleteUserId = $_POST['user_id'];
                                // Delete user from the database
                                $deleteSql = "DELETE FROM users WHERE user_id = $deleteUserId";
                                if ($userConn->query($deleteSql) === TRUE) {
                                    echo "<script>alert('User deleted successfully');</script>";
                                    // Redirect to refresh the page
                                    echo "<script>window.location.href = 'doctorsdash.php';</script>";
                                } else {
                                    echo "Error deleting record: " . $userConn->error;
                                }
                            }

                            // Fetch users from the database
                            $userSql = "SELECT * FROM users";
                            $userResult = $userConn->query($userSql);

                            // Display users
                            if ($userResult->num_rows > 0) {
                                while ($row = $userResult->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='border px-4 py-2'>" . $row["user_id"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["first_name"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["last_name"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["email"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["created_at"] . "</td>";
                                    echo "<td class='border px-4 py-2'>
                                            <form method='post'>
                                                <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                                                <button type='submit' name='delete_user' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button>
                                            </form>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='border px-4 py-2 text-center'>No users found</td></tr>";
                            }

                            // Close the user database connection
                            $userConn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="mb-8">
                <h1 class="text-2xl font-semibold mb-4">Users Messages / Questions</h1>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">First Name</th>
                                <th class="px-4 py-2">Last Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone Number</th>
                                <th class="px-4 py-2">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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

                            // Fetch messages from the contact table
                            $sql = "SELECT * FROM contact";
                            $result = $conn->query($sql);

                            // Display messages
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='border px-4 py-2'>" . $row["first_name"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["last_name"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["email"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["phone_number"] . "</td>";
                                    echo "<td class='border px-4 py-2'>" . $row["message"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>No messages found</td></tr>";
                            }

                            // Close connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Contact Messages -->
            </div>
            <!-- Patients Connection Requests -->
       
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function answerRequest(requestId) {
            // Show the form to answer the request
            document.getElementById('answerForm').style.display = 'block';
            // Set the request ID in a hidden input field
            document.getElementById('requestId').value = requestId;
        }
    </script>

    <!-- Answer Request Form -->
    <div id="answerForm" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h1 class="text-xl font-semibold mb-4">Answer Request</h1>
            <form action="submit_answer.php" method="post">
                <input type="hidden" name="request_id" id="requestId">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                        Message
                    </label>
                    <textarea name="message" id="message" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" rows="3" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                        Date
                    </label>
                    <input type="date" name="date" id="date" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="background-color :#2cd52c;">send</button>
                <button type="button" onclick="document.getElementById('answerForm').style.display = 'none'" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" style="background-color :#f52d2d;">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>



