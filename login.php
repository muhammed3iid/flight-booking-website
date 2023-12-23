<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "omarayman12345";
    $dbname = "flight_booking";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user is a passenger
    $passengerSql = "SELECT * FROM `passenger` WHERE `email`='$email' AND `password`='$password';";
    $passengerResult = $conn->query($passengerSql);

    if ($passengerResult->num_rows > 0) {
        // Passenger found, login successful
        echo "Passenger login successful!";
    } else {
        // Check if the user is a company
        $companySql = "SELECT * FROM `company` WHERE `email`='$email' AND `password`='$password';";
        $companyResult = $conn->query($companySql);

        if ($companyResult->num_rows > 0) {
            // Company found, login successful
            echo "Company login successful!";
        } else {
            // User not found or invalid credentials
            echo "Invalid credentials. Please try again.";
        }
    }

    $conn->close();
}
?>
