<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carbon Footprint Calculator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(background-image.jpg) no-repeat;
            background-size: cover;
            background-position: center;
            flex-direction: column;
        }

        h1 {
            margin: 20px 0;
            font-size: 32px;
            text-align: center;
        }

        .list {
            list-style-type: none;
            padding: 0;
            max-width: 600px;
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .list li {
            margin-bottom: 15px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .list li a {
            text-decoration: none;
            color: greenyellow;
        }

        .list li:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .list li:last-child {
            margin-bottom: 0;
        }
    </style>

</head>

<body>
    <section>
        <h1>Choose one option to calculate carbon footprint</h1>
        <ul class="list">
            <li>Calculate footprint due to <a href="/evergreenfootprints/car.php">car</a> travel</li>
            <li>Calculate footprint due to <a href="/evergreenfootprints/motorbike.php">motorbike</a> travel</li>
            <li>Calculate footprint due to <a href="/evergreenfootprints/flight.php">flight</a> travel</li>
            <li>Calculate footprint due to <a href="/evergreenfootprints/publictransit.php">public transport</a> travel</li>
            <li>Calculate footprint due to <a href="/evergreenfootprints/carbon.php">daily lifestyle</a> travel</li>
        </ul>
    </section>
</body>

</html>