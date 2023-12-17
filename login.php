<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "omarayman12345";
    $dbname = "flight_booking";

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement based on user type
    if ($userType === "company") {
        $sql = "SELECT * FROM `company` WHERE `email` = '$email'";
    } else {
        $sql = "SELECT * FROM `passenger` WHERE `email` = '$email'";
    }

    // Execute SQL statement
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";
            // Perform any additional actions after successful login
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}
?>
