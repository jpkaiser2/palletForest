<?php
    session_start();
    ob_start();
    echo $_POST["name"];

    $t = $_POST["title"];
    $l = $_POST["location"];
    $a = $_SESSION["username"];
    $d = $_POST["description"];
    echo($a);
    $data = "";


    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }





    $target_dir = "usercontent/tempImages/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }

    $hash = generateRandomString(25);
    $fileStr = $target_dir.$hash.".".$imageFileType;

    rename($target_file, $fileStr);


    $path = $fileStr;









    
function addListing($title, $location, $author, $description){
    $servername = "50.87.221.65";
    $username = "skrappap_access";
    $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
    global $path;

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);
    }
    else{
        echo "Connected successfully";
        $retval = mysqli_select_db( $conn, 'skrappap_palletforest' );
        if(! $retval ) {
            die('Could not select database: ' . mysqli_error($conn));
        }
    }

    $sql = "INSERT INTO listings (title, loc, author, descr, img) values ('$title', '$location', '$author', '$description', '$path')";
    if ($conn->query($sql) === TRUE) {
        echo " Database accessed successfully";
    } 
    else{
        echo "Error creating database: " . $conn->error;
    }
        $conn->close();
        header("Location: account.php");
}

addListing($t, $l, $a, $d);


header("Location: account.php");
ob_end_flush();

?>