<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flightName = $_POST["flightName"];
    $flightFrom = $_POST["flightFrom"]; 
    $flightTo = $_POST["flightTo"]; 
    $flightFees = $_POST["flightFees"];
    $flightTime = $_POST["flightTime"]; 

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "omarayman12345";
    $dbname = "flight_booking";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve company_id from the session
    $company_id = $_SESSION["company_id"];

    $sql = "INSERT INTO `flights` (`flight_id`, `name`, `fees`, `iscompleted`, `company_id`, `time`, `from`, `to`) 
    VALUES (NULL, '$flightName', '$flightFees', '0', '$company_id', '$flightTime', '$flightFrom', '$flightTo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: company_home.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
