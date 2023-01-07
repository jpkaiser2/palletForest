<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html>
<title>Listing | PalletForest</title>

<body>
    <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('menu.php'); ?>
    <br>



    <div class="container" id="container">
        <?php
        $listing = $_GET['listing'];
        $currListing = "";
        $listingOutput = "";
        $title = "";
        $author = "";
        $id = "";
        $loc = "";
        $descr = "";
        $cityName = "";
        $img = "";

        if ($listing != null) {
            require_once "dbConfig.php";
            $id = "";
            $conn = new mysqli($servername, $username, $password);

            if ($conn->connect_error) {

                die("Connection failed: " . $conn->connect_error);
            } else {
                $retval = mysqli_select_db($conn, 'skrappap_palletforest');
                if (!$retval) {
                    die('Could not select database: ' . mysqli_error($conn));
                }
            }

            $sql = "SELECT * FROM listings WHERE id=$listing";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //array_push($ids, $row["id"]);
                    $title = $row["title"];
                    $author = strval($row["author"]);
                    $id = $row["id"];
                    $loc = $row["loc"];
                    $descr = $row["descr"];
                    $img = $row["img"];
                }
            }
            echo ($listingOutput);
        }


        $sql = "SELECT * FROM zips WHERE zip=$loc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cityName = $row["primary_city"] . ", " . $row["state"];
            }
        }
        ?>
        <div class="content">
            <center>
                <img src="<?php echo htmlspecialchars($img) ?>" class="img" />
            </center>
        </div>

        <div class="rightBox">
        <div class="infBox">
            <button class="btn-grad-green" alt="back" onclick="history.back()"><i class="fa-solid fa-chevron-left"></i></button>
            <form action="reportListing.php" method="post" style="display:inline-block">
                <input type="hidden" value="<?php echo $listing;?>" name="id">
                <button class="btn-grad-red" type="submit" alt="report"><i class="fa-solid fa-flag"></i></button>
            </form>
        </div>
        <br>
            <h1><?php echo htmlspecialchars($title) ?></h1>
            <p><?php echo htmlspecialchars($cityName) ?></p>
            <hr>
            <h3><?php echo htmlspecialchars($descr) ?></h3>
            <center>
                <form action="contact.php" method="post">
                    <input type="hidden" value="<?php echo htmlspecialchars($listing) ?>" name="listing">
                    <input type="hidden" value="<?php echo htmlspecialchars($author) ?>" name="author">
                    <button class="btn-grad" type="submit">Contact Lister</button>
                </form>
                <br>
            </center>

        </div>

    </div>


    </div>


</body>


</html>




<style>
    .img {
        max-width: 75%;
        max-height: 75%;
    }

    .map {
        width: 30%;
    }

    body {
        padding: 0px;
        margin: 0;
        background-color: #f7f7f7;
        align-content: flex-start;
        font-family: 'Nunito', sans-serif;
    }

    .centerDiv {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h1 {
        font-size: 40px;
    }


    .btn-grad-red {
        background-image: linear-gradient(to right, #ff2300 0%, #ff7964  51%, #ff2300  100%);
        margin: 10px;
        padding: 10px 10px;
        text-align: center;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        border: none;
        width: fit-content;
        text-decoration: none;
        display:inline-block;
    }

    .btn-grad-red:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }
    .btn-grad-green {
        background-image: linear-gradient(to right, #145a32  0%,  #27ae60   51%,  #145a32   100%);
        margin: 10px;
        padding: 10px 10px;
        text-align: center;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display:inline-block;
        border: none;
        width: fit-content;
        text-decoration: none;
    }

    .btn-grad-green:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }



    @media screen and (max-width: 599px) {
        .rightBox {
            bottom: 0;
            background-color: #ececec;
            height: auto;
            padding: 5px;
        }

        .content {
            width: 100%;
        }

        .btn-grad {
            background-image: linear-gradient(to right, #243E36 0%, #0d8a65 51%, #243E36 100%);
            padding: 15px 45px;
            align-self: center;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
            border: none;
            width: 90%;
            margin: 0;
        }

        .btn-grad:hover {
            background-position: right center;
            /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }
    }



    @media only screen and (min-width: 600px) {
        .rightBox {

            right: 0;
            padding: 10px;
            background-color: #ececec;
            width: 33.3%;
            height: 100%;
            margin: 0;
            position: fixed;
            overflow: auto;
            top: 61px;
            z-index: -1;
        }

        .content {
            width: 66.66%;
            position: absolute;
            z-index: -1;
        }

        .btn-grad {
            background-image: linear-gradient(to right, #243E36 0%, #0d8a65 51%, #243E36 100%);

            padding: 15px 45px;
            align-self: center;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
            border: none;
            bottom: 15%;
            position: absolute;
            width: 90%;
            margin: 0;
        }

        .btn-grad:hover {
            background-position: right center;
            /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }
    }
</style>