<?php
if(isset($_GET['distance']) && isset($_GET['vehicle'])) {
    $distance = floatval($_GET['distance']);
    $vehicle = $_GET['vehicle'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://carbonfootprint1.p.rapidapi.com/CarbonFootprintFromMotorBike?type=$vehicle&distance=$distance",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: carbonfootprint1.p.rapidapi.com",
            "X-RapidAPI-Key: c11129afb4msh827c0853a64ab1cp1bd4d0jsn2e10da394a07"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
} else {
    echo "Error: Distance or vehicle not provided.";
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
            display: none;
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
        <form id="carbonForm" method="GET">
            <label for="distance">Distance (in km):</label>
            <input class="distance" type="number" id="distance" name="distance" required placeholder="Enter distance">

            <label for="vehicle">Vehicle Type:</label>
            <select class="select" id="vehicle" name="vehicle" required>
                <option value="SmallMotorBike">Small MotorBike</option>
                <option value="MediumMotorBike">Medium MotorBike</option>
                <option value="LargeMotorBike">Large MotorBike</option>
            </select>
            <button type="submit" onclick="calculateFootprint()">Calculate</button>
        </form>

    <script>
        function analyzeFurther() {
            window.location.href = "analysis.html";
        }

        function calculateFootprint() {
            const form = document.getElementById('carbonForm');
            const formData = new FormData(form);

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const result = JSON.parse(this.responseText);
                    displayResult(result);
                }
            };
            xhr.open("GET", "api_call.php?" + new URLSearchParams(formData).toString(), true);
            xhr.send();
        }
    </script>
</body>

</html>