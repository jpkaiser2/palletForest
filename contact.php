<?php
    ob_start();
    session_start();
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $currUsr = $_SESSION['username'];
    $usrToSendTo = $_POST["author"];
    $listing = $_POST["listing"];
    $m = "";

    require_once "dbConfig.php";    
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        $retval = mysqli_select_db( $conn, 'skrappap_palletforest' );
        if(! $retval ) {
            die('Could not select database: ' . mysqli_error($conn));
        }
    }

    $sql = "INSERT INTO `messages` (to_usr, from_usr, listing) VALUES ('$usrToSendTo', '$currUsr', '$listing')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    require_once "dbConfig.php";    
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        $retval = mysqli_select_db( $conn, 'skrappap_palletforest' );
        if(! $retval ) {
            die('Could not select database: ' . mysqli_error($conn));
        }
    }

    $sql = "SELECT * FROM `messages` WHERE `to_usr`='$usrToSendTo' AND `from_usr`='$currUsr' AND `reply`=0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $m = $row["id"];
        echo "hi";
    }
    } else {
        echo "0 results";
    }

    $conn->close();
    header("Location: https://palletforest.com/messageViewer.php?m=".$m);
    ob_end_flush();
