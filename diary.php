<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'diary';

// Establish a database connection
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables to store user data
$id = 1; // Replace with the user's actual ID
$username = '';
$email = '';
$password = '';

// Retrieve the user's current data from the database
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
}

if (isset($_POST['update'])) {
    $newUsername = $_POST['userName'];
    $newEmail = $_POST['myemail'];
    $newPassword = $_POST['password'];

    $sql = "UPDATE users SET username='$newUsername', email='$newEmail', password='$newPassword' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User information updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating user information: ' . mysqli_error($conn) . '");</script>';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary</title>
    <link rel="stylesheet" href="diary.css">
</head>

<body>
<nav>
        <div class="link">
            <a href="diary.php">Diary</a><br>
        </div>
        <div class="link">
            <a href="gallery.php">Pictures</a><br>
        </div>
        <div class="link">
            <a href="about.php">About</a><br>
        </div>

        <div class="log">
            <a href="login.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome to your Diary <span>
                <?php echo $username ?>
            </span>!</h1>
        <hr>
        <!-- Diary here -->
        <div class="posted-diary">
            <!-- Display diary entries here -->
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "diary";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection error: " . mysqli_connect_error());
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $date = $_POST['date'];
                $diary = $_POST['diary'];

                $sql = "INSERT INTO diary (date, diary) VALUES ('$date', '$diary')";
                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Record inserted successfully");</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

            }


            $sql = "SELECT * FROM diary";
            $result = $conn->query($sql);




            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="diary-entry">';
                    echo '<div class="date">' . $row['date'] . '</div>';
                    echo '<div class="diary-content">' . $row['diary'] . '</div>';
                    echo '</div>';
                }
            } else {
                echo "No diary entries found.";
            }

            $conn->close()
                ?>
        </div>
        <!-- Form -->
        <div class="diary">
            <form action="diary.php" method="post">
                <input type="date" name="date" required>
                <input type="text" name="diary" id="diary" placeholder="Happy day" required><br>
                <input type="submit" value="Add diary" class="submit">
            </form>
        </div>
    </div>
</body>

</html>