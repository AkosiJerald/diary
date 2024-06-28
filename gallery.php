<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "diary";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    if ($_FILES["image"]["error"] == 4) {
        echo
            "<script> alert('Image Does Not Exist'); </script>"
        ;
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
                "
                    <script>
                        alert('Invalid Image Extension');
                    </script>";
        } else if ($fileSize > 1000000) {
            echo
                "
                <script>
                    alert('Image Size Is Too Large');
                </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'uploads/' . $newImageName);
            $query = "INSERT INTO upimg VALUES('', '$name', '$newImageName')";
            mysqli_query($conn, $query);
            echo
                "";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gallery</title>
    <link rel="stylesheet" href="style11.css">

    <style>
        body {
            overflow: hidden;
        }

        @media (max-width:700px) {
            .img-container {
                width: 86%;
                height: 75vh;
                position: fixed;
                margin: 10px;
                box-shadow: 0px 0px 40px rgb(83, 65, 65);
                overflow-y: auto;
                border-radius: 5px;
                border: 1px solid rgb(180, 165, 165);

            }

            .upgaller img {
               max-width: 100%;
               bottom: 2px solid black;
               position: relative;
               left: 14%;
            }

            .upgaller img:hover{
                transform: scale(1.2);
                width: 300px;
            }
        }
    </style>
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

    <div class="container1">
        <h2>Upload you memorable image for today</h2>
        <form class="" action="gallery.php" method="post" autocomplete="off" enctype="multipart/form-data">

            <input type="text" name="name" id="name" placeholder="Title" class="inputtitle">
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
            <button type="submit" name="submit" class="imgsub">Submit</button>
        </form>


        <div class="img-container">
            <div class="upgaller">
                <?php
                $i = 1;
                $rows = mysqli_query($conn, "SELECT * FROM upimg ORDER BY id DESC");
                ?>

                <?php foreach ($rows as $row): ?>
                    <div style="display:block;margin-bottom:5px;padding-top:20px">
                        <img src="uploads/<?php echo $row["img"]; ?>" width=200 title="<?php echo $row['name']; ?>">

                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</body>

</html>