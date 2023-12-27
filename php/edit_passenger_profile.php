<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$passenger_edit_id = $_GET["edit_id"];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "omarayman12345";
$dbname = "flight_booking";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the form submission to update the passenger information

    // Sanitize inputs to prevent SQL injection (you can add more fields as needed)
    $newName =  $_POST["new_name"];
    $newEmail =  $_POST["new_email"];
    $newTel = $_POST["new_tel"];

    // Update the company information in the database
    $updateQuery = "UPDATE `passenger` SET
                `name` = '$newName',
                `email` = '$newEmail',
                `tel` = '$newTel'
                WHERE `passenger_id` = $passenger_edit_id";

    if ($conn->query($updateQuery) === TRUE) {
        // Use JavaScript to redirect after successful update
        echo "passenger information updated successfully";
    } else {
        echo "Error updating passenger information: " . $conn->error;
    }
}

// Retrieve the current passenger information for pre-filling the form
$passengerQuery = "SELECT * FROM `passenger` WHERE `passenger_id` = $passenger_edit_id";
$passengerResult = $conn->query($passengerQuery);

if ($passengerResult->num_rows > 0) {
    $passengerData = $passengerResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $passengerData["name"]; ?> Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            align-content: center;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <!-- Edit passenger Profile Form -->
    <form method="post" action="">
        <label for="new_name">Name:</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $passengerData["name"]; ?>" >

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $passengerData["email"]; ?>">

        <label for="new_tel">Tel:</label>
        <input type="text" id="new_tel" name="new_tel" value="<?php echo $passengerData["tel"]; ?>" >

        <button type="submit">Update</button>
    </form>

</body>

</html>

<?php
}

$conn->close();
?>
