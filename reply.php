<?php
ob_start();
?>
<?php

    $text = strval($_POST['text']);
    $text = preg_replace('/[^A-Za-z0-9\- ]/', '', $text);
    echo $text;
    $reply = strval($_POST['reply']);
    $text = $text."...";
    $from = $_POST['from'];
    $to_ = $_POST['to'];
    //echo $to_;
    $emailto = '';

    session_start();
    $user = strval($_SESSION["username"]);

    $servername = "50.87.221.65";
    $username = "skrappap_access";
    $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
    $dbname = "skrappap_palletforest";
    $id = "";
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
    
    $sql = "INSERT INTO messages (body, reply, from_usr, to_usr) values ('$text', '$reply', '$from', '$to')";
    if ($conn->query($sql) === TRUE) {
        //echo " Database accessed successfully";
        
    } 
    else{
       // echo "Error sending message: " . $conn->error. ". Please try again later.";
    }
    $sql = "SELECT * FROM `users` WHERE `username`='$to_'";
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $emailto = $row['email'];
    }
    } else {
    //echo "0 results";
    }

    $conn->close();
    
    
    $toname = $user;
    $emailfrom = 'no_reply_mail@palletforest.com';
    $fromname = 'PalletForest Mail';
    $subject = 'New Message on PalletForest';
    $messagebody = "
    <html>
    <body>
    <p>".$_POST['text']."</p>
    <br>
    <a href='palletforest.com/messageViewer.php?m=$reply'>View on PalletForest</a>
    </body>
    </html>
    ";
    $headers = 
        'Return-Path: ' . $emailfrom . "\r\n" . 
        'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
        'X-Priority: 3' . "\r\n" . 
        'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
        'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" . 
        'Content-Transfer-Encoding: 8bit' . "\r\n" . 
        'Content-Type: text/html; charset=UTF-8' . "\r\n";
    $params = '-f ' . $emailfrom;
    $test = mail($emailto, $subject, $messagebody, $headers, $params);
    // $test should be TRUE if the mail function is called correctly

        
    header("Location: messageViewer.php?m="."$reply");
    exit;
    ob_end_flush();

?>
