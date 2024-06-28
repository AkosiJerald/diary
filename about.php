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


// Close the database connection

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>about</title>
  <link rel="stylesheet" href="abt.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .cont {
      height: 65vh;
      width: 55%;
      left: 25%;
      top: 20%;
      background-color: rgba(223, 215, 215, 0.787);
      margin: 20px 20px 20px 50px;
      border-bottom-left-radius: 95px;
      border-top-right-radius: 95px;
      padding: 60px 90px 10px 90px;

    }
    .cont .name {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    position: relative;
    left: 20%;
    top: -18%;
    font-size: 25px;
  }

    form {
      border: none;
      width: 60%;
      position: relative;
      top: 13%;
      left: 20%;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 15px;
      margin-bottom: 30px;
      border-radius: 5px;
      border: none;
      box-shadow: 5px 3px 3px black;
    }

    input[type=submit] {
      padding: 10px 35px;
      border-radius: 5px;
      border: none;
      position: relative;
      left: 35%;
      box-shadow: 1px 1px 5px black;
    }

    input[type=submit]:hover {
      background-color: black;
      color: #fff;
      box-shadow: -3px 0px 5px white;
    }

    @media (max-width:700px) {
      .cont .name {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    position: relative;
    left: 20%;
    top: -18%;
    font-size: 25px;
    
  }
  .cont {
    height:65vh;
    width: 55%;
    position: relative;
    left: 0;
    top: 20%;
    background-color: rgba(255, 255, 255, 0.787);
    margin: 0px 10px 0px 10px;
    border-bottom-left-radius: 95px;
    border-top-right-radius: 95px;
    padding: 60px 90px 10px 90px;
  }
  .cont .name {
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    position: relative;
    left: 17%;
    top: 3%;
    font-size: 22px;
    margin-bottom: 20px;
  }
  nav{
    height: 8vh;
  }
  form {

width: 100%;
position: relative;
top: 13%;
left: 20%;
}
  form h1{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-bottom: 10px;
    font-size: 17px;
   
    width: 130%;
   }
   input[type=text],  input[type=password]{
    position: relative;
    left: 0;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
   }
   form{
    position: relative;
    left: 0;
   }
   input[type=submit]{
    padding: 10px 15px;
   }
    }
  </style>
</head>

<body>
  <nav>
    <div class="link"><a href="diary.php">Diary</a><br /></div>
    <div class="link"><a href="gallery.php">Pictures</a><br /></div>
    <div class="link"><a href="about.php">About</a><br /></div>

    <div class="log">
      <a href="login.php">Logout</a>
    </div>
  </nav>
  <div class="cont">
    <!--img dp-->
    <div>
      <img src="360_F_557759175_UvyJH8yZz03WIIuzOF8b14psOnExZOdz.jpg" alt="" class="profile" />
    </div>


    <!--name-->
    <div class="name">
      <p>
        <?php $query = "SELECT username FROM `users`;";
        // FETCHING DATA FROM DATABASE 
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          // OUTPUT DATA OF EACH ROW 
          while ($row = mysqli_fetch_assoc($result)) {
            echo $row["username"] . "<br>";
          }
        } else {
          echo "0 results";
        } ?>
      </p>
    </div>
    <form class="form" action="about.php" method="post">
      <h1>Update your Info</h1>
      <input type="text" id="userName" name="userName" placeholder="Name"><br>
      <input type="text" id="email" name="myemail" placeholder="Email"><br>
      <input type="password" id="pswd" name="password" placeholder="Password"><br>
      <input type="submit" name="update" value="Update">
    </form>
  </div>
  <script src="script.js"></script>
</body>

</html>