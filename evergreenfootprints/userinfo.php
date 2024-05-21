<?php
session_start();

$host = 'localhost';
$dbname = 'evergreenfootprints';
$username = 'root';
$password = '';
$port = '3307';
$error = "";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error = "Connection failed: " . $e->getMessage();
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user data from the database
    $sql = "SELECT * FROM userinfo WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        $userData = $result->fetch(PDO::FETCH_ASSOC);
    }
}

// If form is submitted and fields are not empty
if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['bio'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];

    if (isset($userData)) {
        // Update user data
        $sql = "UPDATE userinfo SET address='$address', phone='$phone', bio='$bio' WHERE username='$username'";
    } else {
        // Insert new user data
        $sql = "INSERT INTO userinfo (username, name, address, phone, bio) VALUES ('$username', '$name', '$address', '$phone', '$bio')";
    }

    try {
        $conn->exec($sql);
        echo '<script>
            alert("Record updated successfully");
        </script>';
    } catch (PDOException $e) {
        $error = "Error updating record: " . $e->getMessage();
    }
}

$conn = null; // Close the connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url(https://cdna.artstation.com/p/assets/images/images/025/102/490/large/jorge-jacinto-wisp-red.jpg?1584627212);
        }

        #profile {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        #profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
            background-color: rgb(89, 187, 187);
        }

        .action-buttons button {
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

        .action-buttons button:hover {
            background: #0C4F60;
        }

        .name {
            color: white;
        }

        .edit-form {
            display: none;
            margin-top: 20px;
        }

        .edit-form input {
            padding: 8px;
            margin: 5px;
            width: calc(100% - 20px);
            border-radius: 9px;
            border: 1px solid #ccc;
        }

        .edit-form button {
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

        .edit-form button:hover {
            background: #0C4F60;
        }
    </style>
</head>

<body>

    <div id="profile">
        <h1>Profile</h1>
        <div class="profile-info">
            <h2 class="name">Name: <?php echo isset($userData['name']) ? $userData['name'] : ""; ?></h2>
            <h2 class="phone">Phone: <?php echo isset($userData['phone']) ? $userData['phone'] : ""; ?></h2>
            <h2 class="address">Address: <?php echo isset($userData['address']) ? $userData['address'] : ""; ?></h2>
            <h2 class="bio">Bio: <?php echo isset($userData['bio']) ? $userData['bio'] : ""; ?></h2>
        </div>
        <div class="action-buttons">
            <button onclick="toggleEditForm()">Edit Profile</button>
        </div>
        <form class="edit-form" id="editForm" action="" method="POST">
            <input type="text" name="name" value="<?php echo isset($userData['name']) ? $userData['name'] : ""; ?>" placeholder="New Name">
            <input type="text" name="address" value="<?php echo isset($userData['address']) ? $userData['address'] : ""; ?>" placeholder="New Address">
            <input type="tel" name="phone" value="<?php echo isset($userData['phone']) ? $userData['phone'] : ""; ?>" placeholder="New Phone">
            <textarea name="bio" placeholder="New Bio"><?php echo isset($userData['bio']) ? $userData['bio'] : ""; ?></textarea>
            <button type="submit" name="submit">Save</button>
        </form>
    </div>

    <script>
        function toggleEditForm() {
            var form = document.getElementById("editForm");
            form.style.display = (form.style.display === "none") ? "block" : "none";
        }
    </script>

    <?php if ($error) : ?>
        <script>
            alert("<?php echo $error; ?>");
        </script>
    <?php endif; ?>

</body>

</html>