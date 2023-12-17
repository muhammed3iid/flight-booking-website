<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $usernameform = $_POST["username"]; 
    $name = $_POST["name"];
    $passwordform = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    $telephone = $_POST["telephone"];
    $userType = $_POST["userType"];

    
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

    // Prepare SQL statement based on user type
    if ($userType === "company") {
        $companyName=$_POST["companyName"];
        $sql = "INSERT INTO `company` (`company_id`, `name`, `bio`, `address`, `location`, `username`, `password`, `email`, `tel`) 
        VALUES (NULL, '$companyName', '', '', '', '$usernameform', '$passwordform', '$email', '$telephone');";
    } else {
        $sql = "INSERT INTO `passenger` (`passenger_id`, `name`, `email`, `password`, `tel`) 
        VALUES (NULL, '$name', '$email', '$passwordform', '$telephone');";
    }

   
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
