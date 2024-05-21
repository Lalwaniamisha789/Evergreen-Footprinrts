<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve data from the POST request
$distance = $_POST['distance'];
$vehicle = $_POST['vehicle'];
$carbonFootprint = calculateCarbonFootprint($distance, $vehicle); // Calculate carbon footprint (you need to implement this function)

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "evergreenfootprints";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve username from the session data
    $username = $_SESSION['username'];

    // Prepare and execute SQL statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO carprints (username, distance, vehicle, carbon_footprint) VALUES (:username, :distance, :vehicle, :carbon_footprint)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':distance', $distance);
    $stmt->bindParam(':vehicle', $vehicle);
    $stmt->bindParam(':carbon_footprint', $carbonFootprint);
    $stmt->execute();

    // Redirect back to the form page
    header("Location: index.html");
    exit();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carbon Footprint Calculator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(https://cdna.artstation.com/p/assets/images/images/025/102/490/large/jorge-jacinto-wisp-red.jpg?1584627212);
        }

        .calculator-container {
            border-radius: 8px;
            color: white;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .input,
        .select {
            border-radius: 20px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #000000;
            border-radius: 4px;
        }

        button {
            background-color: #226A80;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
            transition-property: background;
        }

        button:hover {
            background: #0c4f60;
        }
    </style>
</head>

<body>
    <div class="calculator-container">
        <h2>Carbon Footprint Calculator</h2>
        <form id="carbonForm">
            <label for="distance">Distance (in km):</label>
            <input class="distance" type="number" id="distance" name="distance" required placeholder="Enter distance">

            <label for="vehicle">Vehicle Type:</label>
            <select class="select" id="vehicle" name="vehicle" required>
                <option value="SmallPetrolCar">Small Petrol Car</option>
                <option value="MediumDieselCar">Medium Diesel Car</option>
                <option value="MediumPetrolCar">Medium Petrol Car</option>
                <option value="LargeDieselCar">Large Diesel Car</option>
                <option value="LargePetrolCar">Large Petrol Car</option>
                <option value="MediumHybridCar">Medium Hybrid Car</option>
                <option value="LargeHybridCar">Large Hybrid Car</option>
                <option value="MediumLPGCar">Medium LPG Car</option>
                <option value="SmallPetrolCar">Small Petrol Car</option>
                <option value="MediumHybridCar">Medium Hybrid Car</option>
                <option value="LargeHybridCar">Large Hybrid Car</option>
                <option value="MediumLPGCar">Medium LPG Car</option>
                <option value="LargeLPGCar">Large LPG Car</option>
                <option value="MediumCNGCar">Medium CNG Car</option>
                <option value="LargeCNGCar">Large CNG Car</option>
                <option value="SmallPetrolVan">Small Petrol Van</option>
                <option value="LargePetrolVan">Large Petrol Van</option>
                <option value="SmallDieselVan">Small Diesel Van</option>
                <option value="MediumDieselVan">Medium Diesel Van</option>
                <option value="LargeDieselVan">Large Diesel Van</option>
                <option value="LPGVan">LPG Van</option>
                <option value="CNGVan">CNG Van</option>
            </select>
            <button type="button" onclick="calculateFootprint()">Calculate</button>
        </form>
    </div>

    <script>
        function calculateFootprint() {
            const distance = document.getElementById('distance').value;
            const vehicle = document.getElementById('vehicle').value;

            // Calculate carbon footprint (You need to implement this)
            const carbonFootprint = calculateCarbonFootprint(distance, vehicle);

            // Prepare data to send to the server
            const data = {
                distance: distance,
                vehicle: vehicle,
                carbonFootprint: carbonFootprint
            };

            // Send data to the server
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Handle the response if needed
                    console.log('Data sent successfully');
                }
            };
            xhr.open("POST", "store_data.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(JSON.stringify(data));
        }

        // Function to calculate carbon footprint
        function calculateCarbonFootprint(distance, vehicle) {
            const emissionRate = {
                "SmallPetrolCar": 120,
                "MediumDieselCar": 140,
                "MediumPetrolCar": 130,
                "LargeDieselCar": 160,
                "LargePetrolCar": 150,
                "MediumHybridCar": 100,
                "LargeHybridCar": 90,
                "MediumLPGCar": 110,
                "LargeLPGCar": 120,
                "MediumCNGCar": 100,
                "LargeCNGCar": 110,
                "SmallPetrolVan": 170,
                "LargePetrolVan": 190,
                "SmallDieselVan": 180,
                "MediumDieselVan": 200,
                "LargeDieselVan": 220,
                "LPGVan": 200,
                "CNGVan": 210
            };

            // If the vehicle type is valid, calculate the carbon footprint
            if (emissionRate.hasOwnProperty(vehicle)) {
                const emissions = emissionRate[vehicle] * distance; // Calculate total emissions
                return emissions.toFixed(2); // Return emissions rounded to 2 decimal places
            } else {
                // If the vehicle type is not found, return an error message
                return "Unknown vehicle type";
            }
        }
    </script>
</body>

</html>

</html>