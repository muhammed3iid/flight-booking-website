<?php
session_start(); // Start the session

$servername = "localhost";
$dbusername = "root";
$dbpassword = "omarayman12345";
$dbname = "flight_booking";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user type is set in the session
if (isset($_SESSION["user_type"])) {
  $userType = $_SESSION["user_type"];

  // Assuming you have stored the company_id in the session during login
  if ($userType == "company" && isset($_SESSION["company_id"]) && isset($_SESSION["company_name"])) {
    $company_id = $_SESSION["company_id"];
    $company_name = $_SESSION["company_name"];
  } else {
    // Handle other user types or scenarios
    $company_id = null;
    $company_name = null;
  }
} else {
  // Handle cases where the user type is not set in the session
  $company_id = null;
  $company_name = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flight Booking</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    nav {
      background-color: #444;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      display: inline;
      margin-right: 20px;
    }

    nav a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    nav a:hover {
      background-color: #555;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>
  <header>
    <h1>Flight Booking</h1>
  </header>

  <nav>
    <ul>
      <li><a href="#"><?php echo $company_name; ?></a></li>
      <li><a href="../pages/add_flight_page.html">Add Flights</a></li>
      <li><a href="compnay_profile.php?profile_id=<?php echo $company_id; ?>">Profile</a></li>
      <li><a href="#" onclick="showMessage()">Messages</a></li>
    </ul>
  </nav>

  <footer>
    &copy; <?php echo date("Y"); ?> Flight Booking. All rights reserved.
  </footer>

  <script>
    function showMessage() {
      alert("Hello! This is a sample message.");
    }
  </script>
</body>

</html>