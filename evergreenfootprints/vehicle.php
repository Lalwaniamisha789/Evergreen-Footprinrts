<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evergreen Footprints</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            font-size: larger;
            color: white;
            background: url("background-image.jpg") no-repeat;
            background-size: cover;
        }

        section {
            padding: 50px;
            text-align: center;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            font-weight: 500;
        }

        .info {
            margin-bottom: 40px;
        }

        .info h2 {
            font-size: 50px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .info h2 span {
            color: #1CEFF2;
        }

        .info p {
            font-size: 25px;
            margin-bottom: 40px;
        }

        .vehicles {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        .vehicle {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
            flex: 1 1 300px;
            height: 400px;
        }

        .vehicle img {
            max-width: 100%;
            max-height: 60%;
            min-width: 100%;
            min-height: 45%;
            border-radius: 5px;
            margin-bottom: 15px;
        }


        .vehicle h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .vehicle p {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .sign-in-btn {
            display: inline-block;
            color: #fff;
            background-color: #1CEFF2;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .sign-in-btn:hover {
            background-color: #0ab8c8;
        }

        .media-icons {
            margin-top: 30px;
        }

        .media-icons a {
            color: #333;
            font-size: 24px;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .media-icons a:hover {
            color: #1CEFF2;
        }
        h3{
            color: black;
        }
    </style>
</head>

<body>
    <section>
        <div class="content">
            <div class="info">
                <h2>We pledge <br><span>The Green!</span></h2>
                <p>Our website calculates the carbon footprint based on the vehicles you use and the distances you travel. Start your eco-friendly journey today!</p>
                <a href="/evergreenfootprints/option.php" class="sign-in-btn">GO</a>
            </div>
            <div class="vehicles">
                <div class="vehicle">
                    <img src="car.jpeg" alt="Car">
                    <h3>Car</h3>
                    <p>Calculate your carbon footprint when driving a car.</p>
                </div>
                <div class="vehicle">
                    <img src="bike.jpeg" alt="Motorbike">
                    <h3>Motorbike</h3>
                    <p>See the environmental impact of using a motorbike.</p>
                </div>
                <div class="vehicle">
                    <img src="plane.jpeg" alt="Flight">
                    <h3>Flight</h3>
                    <p>Discover the carbon impact of your air-trips.</p>
                </div>
            </div>
        </div>
        <div class="media-icons">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </section>
</body>

</html>