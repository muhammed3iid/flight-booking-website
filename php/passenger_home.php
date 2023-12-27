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
if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "passenger" && isset($_SESSION["passenger_id"])) {
    $passenger_id = $_SESSION["passenger_id"];

    // Retrieve passenger information
    $passengerQuery = "SELECT * FROM `passenger` WHERE `passenger_id` = $passenger_id";
    $passengerResult = $conn->query($passengerQuery);

    if ($passengerResult->num_rows > 0) {
        $passengerData = $passengerResult->fetch_assoc();
    } else {
        // Handle case where passenger is not found
        echo "Passenger not found.";
        exit();
    }
} else {
    // Redirect to login if the user is not a passenger
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Home</title>
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

        .passenger-profile {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            align-content: center;
        }

        .passenger-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        p {
            color: #333;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .flights-list {
            margin-top: 20px;
        }

        .profile-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <!-- Passenger Profile Section -->
    <section class="passenger-profile">
        <h2>Welcome, <?php echo $passengerData["name"]; ?>!</h2>

        <!-- Passenger Details -->
        <img src="<?php echo $passengerData["image_url"]; ?>" alt="Passenger Image" class="passenger-image">
        <p><strong>Name:</strong> <?php echo $passengerData["name"]; ?></p>
        <p><strong>Email:</strong> <?php echo $passengerData["email"]; ?></p>
        <p><strong>Tel:</strong> <?php echo $passengerData["tel"]; ?></p>

        <!-- Completed Flights List -->
        <div class="flights-list">
            <h3>Completed Flights</h3>
            <?php
            $completedFlightsQuery = "SELECT * FROM `flights` WHERE `passenger_id` = $passenger_id AND `iscompleted` = '1'";
            $completedFlightsResult = $conn->query($completedFlightsQuery);

            if ($completedFlightsResult->num_rows > 0) {
                while ($completedFlightData = $completedFlightsResult->fetch_assoc()) {
                    echo "<p>{$completedFlightData['name']}</p>";
                }
            } else {
                echo "<p>No completed flights</p>";
            }
            ?>
        </div>

        <!-- Current Flights List -->
        <div class="flights-list">
            <h3>Current Flights</h3>
            <?php
            $currentFlightsQuery = "SELECT * FROM `flights` WHERE `passenger_id` = $passenger_id AND `iscompleted` = '0'";
            $currentFlightsResult = $conn->query($currentFlightsQuery);

            if ($currentFlightsResult->num_rows > 0) {
                while ($currentFlightData = $currentFlightsResult->fetch_assoc()) {
                    echo "<p>{$currentFlightData['name']}</p>";
                }
            } else {
                echo "<p>No current flights</p>";
            }
            ?>
        </div>

        <!-- Profile Link -->
        <a href="passenger_profile.php?profile_id=<?php echo $passenger_id;?>" class="profile-link">View Profile</a>
    </section>

    <!-- Search Flight Link -->
    <a href="search_flight.php" class="profile-link">Search for a Flight</a>

    <!-- Add your additional HTML structure and content here -->

    <script>
        // JavaScript function for demonstration
        function showMessage() {
            alert("Hello! This is a sample message.");
        }
    </script>

</body>

</html>

<?php
$conn->close();
?>
