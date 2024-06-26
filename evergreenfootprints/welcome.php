<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<style>
    @import url('https://fonts.googleapis.com/css2?family=:Poppins:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        color: white;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .logo {
        max-width: 100%;
        max-height: 100px;
        max-width: 100px;
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1000;
    }

    header .logo {
        position: relative;
        color: #000;
        font-size: 30px;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .logo-container {
        position: relative;
        text-align: center;
    }

    .slogan {
        position: absolute;
        bottom: -45px;
        /* Adjust this value as needed */
        left: 75px;
        /* Center horizontally */
        transform: translateX(-50%);
        font-weight: bold;
        color: #fff;
        white-space: nowrap;
        display: inline-block;
        padding: 5px 10px;
        /* Adjust padding as needed */
    }

    section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        background: url(background-image.jpg)no-repeat;
        background-size: cover;
        background-position: center;
    }

    header {
        position: relative;
        top: 0;
        width: 100%;
        padding: 30px 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header .navigation a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        letter-spacing: 1px;
        padding: 2px 15px;
        border-radius: 20px;
        transition: 0.3s;
        transition-property: background;
    }

    header .navigation a:not(:last-child) {
        margin-right: 30px;
    }

    header .navigation a:hover {
        background: #000;
    }

    .navigation a.logout-btn {
        background-color: #f3c623;
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
    }

    .navigation a.logout-btn:hover {
        background-color: #e0b30d;
        /* Change background color on hover */
    }

    .content {
        max-width: 650 px;
        margin: 60px 100px;
    }

    .content .info h2 {
        color: #1CEFF2;
        font-size: 55px;
        text-transform: uppercase;
        font-weight: 800px;
        letter-spacing: 2px;
        line-height: 60px;
        margin-bottom: 30px;
    }

    .content .info h2 span {
        color: #fff;
        font-size: 50px;
        font-weight: 600;
    }

    .content .info p {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 40px;
    }

    .content .sign-in-btn {
        color: #fff;
        background: #226A80;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 2px;
        padding: 10px 20px;
        border-radius: 5px;
        transition: 0.3s;
        transition-property: background;
    }

    .content .sign-in-btn:hover {
        background: #0C4F60;
    }

    .media-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .media-icons a {
        position: relative;
        color: #111;
        font-size: 25px;
        transition: 0.3s;
        transition-property: transform;
    }

    .media-icons a:not(:last-child) {
        margin-right: 60px;
    }

    .media-icons a:hover {
        transform: scale(1.5);
    }

    label {
        display: none;
    }

    #check {
        z-index: 3;
        display: none;
    }

    @media(max-width: 960px) {
        header .navigation {
            display: none;
        }

        label {
            display: block;
            font-size: 25px;
            cursor: pointer;
            transition: 0.3s;
            transition-property: color;
        }

        label:hover {
            color: #fff;
        }

        label .close-btn {
            display: none;
        }

        #check:checked~header .navigation {
            z-index: 2;
            position: fixed;
            background: rgba(15, 135, 139, 0.9);
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }


        #check:checked~.logo-container {
            height: 50px;
            /* Adjust height as needed */
            width: 50px;
            /* Adjust width as needed */
        }

        #check:checked~.logo {
            height: 50px;
            /* Adjust height as needed */
            width: 50px;
            /* Adjust width as needed */
        }

        #check:checked~header .navigation a {
            font-weight: 700;
            margin-right: 0;
            margin-bottom: 50px;
            letter-spacing: 2px;
        }

        #check:checked~header label .menu-btn {
            display: none;
        }

        #check:checked~header label .close-btn {
            z-index: 2;
            display: block;
            position: fixed;
        }

        label .menu-btn {
            position: absolute;
        }

        header .logo {
            position: absolute;
            bottom: -6px;
        }

        .content .info h2 {
            font-size: 45px;
            line-height: 50px;
        }

        .content .info h2 span {
            font-size: 40px;
            font-weight: 600;
        }

        .content .info p {
            font-size: 14px;

        }
    }

    @media (max-width: 560px) {
        .content .info h2 {
            font-size: 35px;
            line-height: 40px;
        }

        .content .info h2 span {
            font-size: 30px;
            font-weight: 600;
        }

        .content .info p {
            font-size: 14px;

        }
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <section>
        <input type="checkbox" id="check">
        <header>
            <div class="logo-container">
                <img src="logo_new-modified.png" alt="LOGO" class="logo">
                <div class="slogan">Curbing the Carbon!!</div>
            </div>
            <div class="navigation">
                <a href="/evergreenfootprints/login.php">Log In</a>
                <a href="/evergreenfootprints/vehicle.php">Vehicle footprint</a>
                <a href="/evergreenfootprints/carbon.php">Daily Footprints</a>
                <a href="/evergreenfootprints/userinfo.php">User Profile</a>
                <a href="/evergreenfootprints/login.php" onclick="logout()">Log Out</a>
            </div>
            <label for="check">
                <i class="fas fa-bars menu-btn"></i>
                <i class="fas fa-times close-btn"></i>
            </label>
        </header>
        <div class="content">
            <div class="info">
                <h2>We pledge <br><span>The Green!</span></h2>
                <p>Our website calculates the carbon footprint if the user based on their daily life activities. We encourage our users to "GO GREEN". You can also see the eco friendly alternatives of your daily life activities on our website. The latest articles abvout laws regating nature are also available, you can contact other encvironment enthusiasta and take part in several environmental campaigns</p>
                <a href="/evergreenfootprints/signup.php" class="sign-in-btn">Sign-up</a>
            </div>
        </div>
        <div class="media-icons">
            <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://twitter.com/?lang=en" target="_blank"><i class="fa-brands fa-twitter"></i></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </section>
</body>

</html>