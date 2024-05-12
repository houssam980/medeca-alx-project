
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
if ($result) {
    // Fetch user data
    $user = $result->fetch_assoc();
} else {
    // Display error message if query fails
    echo "Error fetching user data";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user.css">
    <script src="https://cdn.tailwindcss.com"></script>
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

         
        
  <!-- Content -->
  <div class="content">
            <div id="overview" class="panel">
                <h1>Add Your Blood Tests Values (No Need To specify the value )</h1>

                <!-- Add Data Form -->
                <form class="max-w-sm mx-auto" action="storedata.php" method="post">
                <div class="mb-3">
                        <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your full Name</label>
                        <input type="text" id="full-name" name="username-tosave" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                    <div class="mb-3">
                        <label for="cbc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complete Blood Count (CBC):</label>
                        <input type="text" id="cbc" name="cbc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="bmp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Basic Metabolic Panel (BMP):</label>
                        <input type="text" id="bmp" name="bmp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="cmp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comprehensive Metabolic Panel (CMP):</label>
                        <input type="text" id="cmp" name="cmp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="lipid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lipid Panel:</label>
                        <input type="text" id="lipid" name="lipid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="thyroid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thyroid Panel:</label>
                        <input type="text" id="thyroid" name="thyroid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="coagulation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Coagulation Panel:</label>
                        <input type="text" id="coagulation" name="coagulation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="hormone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hormone Test:</label>
                        <input type="text" id="hormone" name="hormone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="vitamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vitamin and Mineral Test:</label>
                        <input type="text" id="vitamin" name="vitamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="infectious" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Infectious Disease Test:</label>
                        <input type="text" id="infectious" name="infectious" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="mb-3">
                        <label for="drugs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drugs Test:</label>
                        <input type="text" id="drugs" name="drugs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>

                    <div class="flex items-start mb-3"></div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #FF5733;">Save</button>

                </form>
                <!-- End Add Data Form -->
            </div>
            <div id="charts" class="panel">
                <canvas id="chart1"></canvas>
                <!-- Initialize chart1 here -->
            </div>
            <div id="statistics" class="panel">
                <h1>Statistics</h1>
                <div class="bar-chart" style="width: 515px;">
                   

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="width: 514px;">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="position: relative;
    top: 58px">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
          <tr>
              <th scope="col" class="px-6 py-3">
                Blood Test Type
              </th>
              <th scope="col" class="px-6 py-3">
                  <div class="flex items-center">
                      Value
                  </div>
              </th>

          </tr>
      </thead>
      <tbody>
          
      </tbody>
  </table>
</div>
</div>
<br>
<a href="signout.php" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" style="float: right; margin-top: -38px;">Logout</a>

</div>
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="main.js"></script>
</body>

</html>


