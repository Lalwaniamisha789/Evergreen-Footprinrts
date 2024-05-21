<?php
session_start();
$showError = false;
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username and password are filled
    if (empty($username) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
        $showError = true;
    } else {
        // Retrieve user record from the database
        $stmt_check = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt_check->bindParam(':username', $username);
        $stmt_check->execute();
        $user = $stmt_check->fetch();

        // Check if user exists
        if ($user) {
            // Verify hashed password
            if (password_verify($password, $user['password']) == true) {
                // Password is correct, set session variables and redirect to welcome page
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: /evergreenfootprints/welcome.php");
                exit();
            } else {
                // Incorrect password
                $errorMessage = "Invalid password.";
                $showError = true;
            }
        } else {
            // User does not exist
            $errorMessage = "Invalid username.";
            $showError = true;
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-image: url(https://cdna.artstation.com/p/assets/images/images/025/102/490/large/jorge-jacinto-wisp-red.jpg?1584627212);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .alert-container {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 450px;
        }

        .alert {
            position: relative;
            border-radius: 8px;
        }

        .alert-close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        #content_container,
        .login-container {
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
        }

        #password,
        #username,
        #email input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #0c0808;
            border-radius: 4px;
        }

        #button_container {
            margin-top: 20px;
        }

        button {
            background-color: #226A80;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 100px;
            margin-right: 10px;
            transition: background 0.3s;
        }

        button:hover {
            background: #0C4F60;
        }

        .heading {
            color: black;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #000;
        }

        .form-text {
            color: #000;
            font-size: small;
            font-weight: bold;
        }

        .toggle-password {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        .toggle-password .fa-eye-slash {
            display: none;
        }
    </style>
</head>

<body>
    <div class="alert-container">
        <?php
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-close" onclick="this.parentElement.style.display=\'none\';">&times;</span>
                    <strong>Error!</strong> ' . $errorMessage . '
                </div>';
            $showError = false;
            $errorMessage = "";
        }
        ?>
    </div>
    <div id="content_container">
        <h1 class="heading">Login</h1>
        <form action="/evergreenfootprints/login.php" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                            <i class="fas fa-eye-slash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const togglePassword = document.querySelectorAll('.toggle-password');

        togglePassword.forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.parentElement.previousElementSibling;
                const iconEye = this.querySelector('.fa-eye');
                const iconEyeSlash = this.querySelector('.fa-eye-slash');

                if (input.type === 'password') {
                    input.type = 'text';
                    iconEye.style.display = 'none';
                    iconEyeSlash.style.display = 'block';
                } else {
                    input.type = 'password';
                    iconEye.style.display = 'block';
                    iconEyeSlash.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>