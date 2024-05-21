<?php
session_start();

$host = 'localhost';
$dbname = 'evergreenfootprints';
$username = 'root';
$password = '';
$port = '3307';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit script if database connection fails
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT IFNULL(fuelType, 'Total') AS fuelType, 
                            SUM(energyConsumption) AS totalEnergyConsumption, 
                            SUM(dailyCalories) AS totalDailyCalories, 
                            SUM(fuelConsumption) AS totalFuelConsumption, 
                            SUM(co2Emissions) AS totalCO2Emissions,
                            SUM(carbonInCalories) AS totalCarbonInCalories,
                            SUM(totalFootprint) AS totalFootprints 
                            FROM userInputs 
                            WHERE Username = :username 
                            GROUP BY fuelType WITH ROLLUP");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "User not logged in.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carbon Footprint Analysis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            /* Align content vertically */
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(https://cdna.artstation.com/p/assets/images/images/025/102/490/large/jorge-jacinto-wisp-red.jpg?1584627212);
        }

        .analysis-container {
            color: white;
            width: 90vw;
            max-width: 800px;
            text-align: center;
            font-size: 18px;
            /* Increased font size */
            padding: 20px;
            display: flex;
            flex-direction: column;
            /* Align content vertically */
            align-items: center;
        }

        h2 {
            font-size: 36px;
            /* Larger font size for title */
            margin-bottom: 20px;
            /* Increased margin for title */
        }

        #result {
            font-weight: bold;
            margin-bottom: 20px;
        }

        #analysis-section {
            padding: 10px;
            margin-top: auto;
            /* Push to the bottom */
        }

        .analysis-section div {
            text-align: left;
        }

        p {
            color: #010808;
            font-weight: bold;
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ffffff;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #035c5c;
            color: #000;
        }

        canvas {
            background-color: #000;
            margin-top: 20px;
            width: 80%;
            /* Adjust width */
            max-width: 500px;
            /* Max width for responsiveness */
            height: auto;
            /* Automatically adjust height */
        }

        .recommendations {
            text-align: center;
            color: #fff;
            margin-top: 20px;
            font-weight: 600;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="analysis-container">
        <h2>Carbon Footprint Analysis</h2>
        <div id="analysis-section">
            <div id="result">
                <p>Your estimated carbon footprint is</p>
            </div>

            <!-- Display the user data here, for example, in a table -->
            <table id="userInputTable">
                <tr>
                    <th>Fuel Type</th>
                    <th>Total Energy Consumption</th>
                    <th>Total Daily Calories</th>
                    <th>Total Fuel Consumption</th>
                    <th>Total CO2 Emissions</th>
                    <th>Total Carbon In Calories</th>
                    <th>Total Footprints</th>
                </tr>
                <?php foreach ($userData as $data) : ?>
                    <tr>
                        <td><?php echo $data['fuelType']; ?></td>
                        <td><?php echo $data['totalEnergyConsumption']; ?></td>
                        <td><?php echo $data['totalDailyCalories']; ?></td>
                        <td><?php echo $data['totalFuelConsumption']; ?></td>
                        <td><?php echo $data['totalCO2Emissions']; ?></td>
                        <td><?php echo $data['totalCarbonInCalories']; ?></td>
                        <td><?php echo $data['totalFootprints']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <canvas id="myChart"></canvas>

            <div class="recommendations">
                <h3>Recommendations :</h3>
                <ul>
                    <li>Reduce gasoline consumption by using public transport or carpooling.</li>
                    <li>Consider using energy-efficient appliances to lower electricity consumption.</li>
                    <li>Explore a plant-based diet to reduce carbon emissions from food.</li>
                    <li>Minimize water usage by fixing leaks and installing water-saving fixtures.</li>
                    <li>Switch to renewable energy sources such as solar or wind power.</li>
                    <li>Reduce, reuse, and recycle to minimize waste production.</li>
                    <li>Avoid unnecessary air travel and use video conferencing when possible.</li>
                    <li>Plant trees and support reforestation efforts.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Extract data from PHP to JavaScript
        const fuelTypes = <?php echo json_encode(array_column($userData, 'fuelType')); ?>;
        const totalEnergyConsumption = <?php echo json_encode(array_column($userData, 'totalEnergyConsumption')); ?>;
        const totalDailyCalories = <?php echo json_encode(array_column($userData, 'totalDailyCalories')); ?>;
        const totalFuelConsumption = <?php echo json_encode(array_column($userData, 'totalFuelConsumption')); ?>;
        const totalCO2Emissions = <?php echo json_encode(array_column($userData, 'totalCO2Emissions')); ?>;
        const totalCarbonInCalories = <?php echo json_encode(array_column($userData, 'totalCarbonInCalories')); ?>;
        const totalFootprints = <?php echo json_encode(array_column($userData, 'totalFootprints')); ?>;

        // Create chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: fuelTypes,
                datasets: [{
                        label: 'Total Energy Consumption',
                        data: totalEnergyConsumption,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Daily Calories',
                        data: totalDailyCalories,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Fuel Consumption',
                        data: totalFuelConsumption,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total CO2 Emissions',
                        data: totalCO2Emissions,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Carbon In Calories',
                        data: totalCarbonInCalories,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Footprints',
                        data: totalFootprints,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuad'
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
