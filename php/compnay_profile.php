<?php
$company_temp_id = $_GET["profile_id"];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "omarayman12345";
$dbname = "flight_booking";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$companyQuery = "SELECT * FROM `company` WHERE `company_id` = $company_temp_id";
$companyResult = $conn->query($companyQuery);

if ($companyResult->num_rows > 0) {
    $companyData = $companyResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $companyData["name"]; ?> Profile</title>
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

        h2 {
            text-align: center;
            color: #333;
        }

        .company-profile {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            align-content: center;
        }

        .company-logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        p {
            color: #333;
        }

        .edit-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <!-- Company Profile Section -->
    <section class="company-profile">
        <h2><?php echo $companyData["name"]; ?> (Profile)</h2>

        <!-- Logo Image -->
        <img src="<?php echo $companyData["logo_url"]; ?>" alt="Company Logo" class="company-logo">

        <!-- Company Details -->
        <p><strong>Name:</strong> <?php echo $companyData["name"]; ?></p>
        <p><strong>Username:</strong> <?php echo $companyData["username"]; ?></p>
        <p><strong>Email:</strong> <?php echo $companyData["email"]; ?></p>
        <p><strong>Bio:</strong> <?php echo $companyData["bio"]; ?></p>
        <p><strong>Address:</strong> <?php echo $companyData["address"]; ?></p>
        <p><strong>Tel:</strong> <?php echo $companyData["tel"]; ?></p>

        <!-- Flights List (Assuming you have a flights table associated with the company) -->
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

        <!-- Edit Link -->
        <a href="edit_company_profile.php?edit_id=<?php echo $company_temp_id; ?>" class="edit-link">Edit</a>
    </section>

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
}

$conn->close();
?>
