<?php
$host = 'localhost';
$dbname = 'evergreenfootprints';
$username = 'root';
$password = '';
$port = '3307';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit script if database connection fails
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $username = $_SESSION['username']; // Get the username of the logged-in user
        // Get form data
        $energyConsumption = intval($_POST['energyConsumption']);
        $dailyCalories = intval($_POST['dailyCalories']);
        $fuelType = $_POST['fuelType'];
        $fuelConsumption = floatval($_POST['fuelConsumption']);

        // Calculating CO2 emissions
        switch ($fuelType) {
            case 'gasoline':
                $co2Emissions = $fuelConsumption * 2.31;
                break;
            case 'diesel':
                $co2Emissions = $fuelConsumption * 2.68;
                break;
            case 'electric':
                $co2Emissions = $fuelConsumption * 0.5; // 0.5 kg/kWh
                break;
            case 'petrol':
                $co2Emissions = $fuelConsumption * 2.21;
                break;
            default:
                $co2Emissions = 0;
        }

        // Calculating total CO2 emissions
        $energyCo2Emissions = $energyConsumption * 0.5; // 0.5 kg/kWh
        $totalCo2Emissions = $co2Emissions + $energyCo2Emissions;
        $carbonInCalories = $dailyCalories * 0.00015; // 0.00015 kg CO2 equivalent per calorie
        $totalFootprint = $totalCo2Emissions + $carbonInCalories;

        // SQL query to insert data into database
        $stmt = $conn->prepare("INSERT INTO userInputs (username, energyConsumption, dailyCalories, fuelType, fuelConsumption, totalFootprint, co2Emissions, carbonInCalories)
        VALUES (:username, :energyConsumption, :dailyCalories, :fuelType, :fuelConsumption, :totalFootprint, :co2Emissions, :carbonInCalories)");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':energyConsumption', $energyConsumption);
        $stmt->bindParam(':dailyCalories', $dailyCalories);
        $stmt->bindParam(':fuelType', $fuelType);
        $stmt->bindParam(':fuelConsumption', $fuelConsumption);
        $stmt->bindParam(':totalFootprint', $totalFootprint);
        $stmt->bindParam(':co2Emissions', $co2Emissions);
        $stmt->bindParam(':carbonInCalories', $carbonInCalories);

        if ($stmt->execute()) {
            $resultMessage = "<div id='result' class='" . ($totalFootprint <= 20.1 ? 'safe-level' : 'unsafe-level') . "'>Your carbon footprint: $totalFootprint kg CO2</div>";
            $analyzeButton = "<button id='analyze-button' onclick=\"window.location.href='/evergreenfootprints/analyze.php'\">Analyze Further</button>";
        } else {
            $resultMessage = "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
        }
    } else {
        $resultMessage = "Please log in to calculate your carbon footprint.";
    }
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

        #result {
            margin-top: 20px;
            font-weight: bold;
        }

        .unsafe-level {
            color: red;
            /* Red color for unsafe level */
        }

        .safe-level {
            color: #1CEFF2;
            /* Blue color for safe level */
        }

        #analyze-button {
            background-color: #226A80;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
            transition-property: background;
        }

        #analyze-button:hover {
            background: #0C4F60;
        }
    </style>
</head>

<body>

    <div class="calculator-container">
        <h2>Carbon Footprint Calculator</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="energyConsumption">Energy Consumption (kWh):</label>
            <input class="input" type="number" name="energyConsumption" required placeholder="Enter energy consumption">

            <label for="dailyCalories">Daily Calorie Consumption:</label>
            <input class="input" type="number" name="dailyCalories" required placeholder="Enter daily calorie consumption">

            <label for="fuelType">Fuel Type:</label>
            <select class="select" name="fuelType" required>
                <option value="gasoline">Gasoline</option>
                <option value="diesel">Diesel</option>
                <option value="electric">Electric</option>
                <option value="petrol">Petrol</option>
            </select>

            <label for="fuelConsumption">Fuel Consumption (liters or kWh):</label>
            <input class="input" type="number" name="fuelConsumption" required placeholder="Enter fuel consumption">

            <button type="submit">Calculate</button>
        </form>

        <?php
        if (isset($resultMessage)) {
            echo "<div id='result-container'>$resultMessage";
            if (isset($analyzeButton)) {
                echo $analyzeButton;
            }
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>