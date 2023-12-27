<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "omarayman12345";
    $dbname = "flight_booking";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $passengerSql = "SELECT * FROM `passenger` WHERE `email`='$email' AND `password`='$password'";
    $passengerResult = $conn->query($passengerSql);

    if ($passengerResult->num_rows > 0) {
        $passengerData = $passengerResult->fetch_assoc();

        // Store passenger_id in the session
        $_SESSION["user_type"] = "passenger";
        $_SESSION["passenger_id"] = $passengerData["passenger_id"];

        header("Location: passenger_home.php");
        exit();
    } else {
        $companySql = "SELECT * FROM `company` WHERE `email`='$email' AND `password`='$password';";
        $companyResult = $conn->query($companySql);

        if ($companyResult->num_rows > 0) {
            $companyData = $companyResult->fetch_assoc();

            // Store company_id in the session
            $_SESSION["user_type"] = "company";
            $_SESSION["company_id"] = $companyData["company_id"];
            $_SESSION["company_name"] = $companyData["name"];

            header("Location: company_home.php");
            exit();
        } else {
            echo "Invalid credentials. Please try again.";
        }
    }

    $conn->close();

}
?>