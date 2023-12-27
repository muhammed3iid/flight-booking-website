<?php
$passenger_temp_id = $_GET["profile_id"];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "omarayman12345";
$dbname = "flight_booking";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$passengerQuery = "SELECT * FROM `passenger` WHERE `passenger_id` = $passenger_temp_id";
$passengerResult = $conn->query($passengerQuery);

if ($passengerResult->num_rows > 0) {
    $passengerData = $passengerResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $passengerData["name"]; ?> Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-direction: column;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-top: 20px;
        }

        .passenger-profile {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            margin-top: 20px;
        }

        .passenger-picture {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            margin: 0;
            margin-bottom: 10px;
        }

        .flights-list {
            margin-top: 20px;
            text-align: left;
        }

        .flights-list h3 {
            color: #333;
        }

        .flights-list p {
            margin: 0;
            margin-bottom: 5px;
        }

        .edit-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <header>
        <h1>Flight Booking</h1>
    </header>

    <!-- Passenger Profile Section -->
    <section class="passenger-profile">
        <h2><?php echo $passengerData["name"]; ?> (Profile)</h2>

        <!-- Passenger Picture -->
        <img src="<?php echo $passengerData["logo_url"]; ?>" alt="Passenger Picture" class="passenger-picture">

        <!-- Passenger Details -->
        <p><strong>Name:</strong> <?php echo $passengerData["name"]; ?></p>
        <p><strong>Email:</strong> <?php echo $passengerData["email"]; ?></p>
        <p><strong>Tel:</strong> <?php echo $passengerData["tel"]; ?></p>

        <!-- Flights List (Assuming you have a flights table associated with the passenger) -->
        <div class="flights-list">
            <h3>Flights List</h3>
            <?php
            $flightsQuery = "SELECT * FROM `flights` WHERE `company_id` = $company_temp_id";
            $flightsResult = $conn->query($flightsQuery);

            if ($flightsResult->num_rows > 0) {
                while ($flightData = $flightsResult->fetch_assoc()) {
                    echo "<p>{$flightData['name']}</p>";
                }
            } else {
                echo "<p>No flights available</p>";
            }
            ?>
        </div>

        <!-- Edit Link -->
        <a href="edit_passenger_profile.php?edit_id=<?php echo $passenger_temp_id; ?>" class="edit-link">Edit</a>
    </section>

    <footer>
        &copy; <?php echo date("Y"); ?> Flight Booking. All rights reserved.
    </footer>
</body>

</html>


<?php
}

$conn->close();
?>
