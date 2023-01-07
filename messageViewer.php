<?php 
session_start(); 
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  }
?>

<html>
    <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php  require('menu.php');
$msg = $_GET['m'];
?>

</html>



<div class="pageContainer">
    <br>
    <br>

<br>
<div class="longWhite">
    <br>
<div class="infBox">
    <a class="btn-grad-green" alt="back" href="messages.php"><i class="fa-solid fa-chevron-left"></i></a>
    <!-- <a class="btn-grad-red" alt="delete"><i class="fa-solid fa-trash"></i></a> -->
    <form action="report.php" method="post" style="display:inline-block">
        <input type="hidden" value="<?php echo $msg;?>" name="id">
        <button class="btn-grad-red" type="submit" alt="report"><i class="fa-solid fa-flag"></i></button>
    </form>
</div>
</div>
<br>
<br>
<br>
<br>



        <?php
       
                $user = strval($_SESSION["username"]);
                //echo $user;
                $msg = $_GET['m'];

                $servername = "50.87.221.65";
                $username = "skrappap_access";
                $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
                $conn = new mysqli($servername, $username, $password);
                $to_usr = "";

                if ($conn->connect_error) {
                    echo("Connection failed: " . $conn->connect_error);
                }
                else{
                    $retval = mysqli_select_db( $conn, 'skrappap_palletforest' );
                    if(! $retval ) {
                        echo('Could not select database: ' . mysqli_error($conn));
                    }
                }

                $sql = "SELECT * FROM `messages` WHERE `id`=$msg";
                $result = mysqli_query($conn, $sql);
                if ($conn->query($sql) == TRUE) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['from_usr'] === $user){
                            $to_usr = $row["to_usr"];
                        }
                        else{
                            $to_usr = $row["from_usr"];
                        }
                    }
                }






                $sql = "SELECT * FROM `messages` WHERE `reply`=$msg";
                $result = mysqli_query($conn, $sql);
                if ($conn->query($sql) == TRUE) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['from_usr'] === $user){
                            echo "
                            <div class='box'>".substr($row['body'], 0, -3)."</div>
                            <br>
                            <br>
                            <br>
                            ";
                        }
                        else{
                            echo "
                            <div class='box2'>".substr($row['body'], 0, -3)."</div>
                            <br>
                            <br>
                            <br>
                   
                            ";
                        }
                        
                    }
                }
                else{
                    echo "Error: Message does not exist";
                }
            
?>
<br>
<br>
<br>
<br>
<br>
<br>


</div>

<form method="post" action="reply.php">
        <input readonly type="hidden" name="reply" class="" value="<?php echo htmlspecialchars($_GET['m']);?>">
        <input readonly type="hidden" name="from" class="" value="<?php echo htmlspecialchars(strval($_SESSION["username"]));?>">
        <input readonly type="hidden" name="to" class="" value="<?php echo htmlspecialchars($to_usr);?>">
            
        <div class="bottom">
            <center>
            <input class="textBox" name="text" type="text" placeholder="type something here...">
            <button class="sendBtn" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </center>
        </div>
    </form>
<script>window.scrollTo(0, document.body.scrollHeight);</script>

<style>
    .below{
        top: 20;
    }
    .sendBtn{
        background-image: linear-gradient(to right, #243E36 0%, #0d8a65  51%, #243E36  100%);
        border: none;
        padding: 5px 5px;
        border-radius: 4px;
        width: 15%;
        height: 50px;
        text-align: center;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
    }
    .sendBtn:hover{
        background-position: right center;
        color: #fff;
        text-decoration: none;

    }
    .textBox{
        width: 80%;
        height: 50px;
        border: solid 2px lightgray;
        border-radius: 4px;
        text-decoration: none;
    }
    .textBox:focus {
        outline: none;
    }
    .bottom{
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: white;
        height: 8%;
        align-items: center;
    }
    .box{
        border-radius: 10px;
        background-color: #0d8a65;
        color: white;
        width:fit-content;
        height: fit-content;
        padding: 5px 5px;
        right: 10%;
        position: absolute;

    }
    .box2{
        border-radius: 10px;
        background-color: lightgray;
        color: white;
        width:fit-content;
        height: fit-content;
        padding: 5px 5px;
        left: 10%;
        position: absolute;
    }

    body{
        font-family: 'Nunito', sans-serif;
        padding: 0; 
        margin: 0;
    }
    .btn-grad {
        background-image: linear-gradient(to right, #243E36 0%, #0d8a65  51%, #243E36  100%);
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
        border: none;
        width: 20%;
        text-decoration: none;
    }

    .btn-grad:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
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
    .btn-grad-yellow {
        background-image: linear-gradient(to right, #ffe74d 0%, #ffef8d  51%, #ffe74d  100%);
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

    .btn-grad-yellow:hover {
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
    .bodyText{
        background-color: white;
        padding: 15px 45px;
        border-radius: 10px;
        height: fit-content;
    }
    .subjText{
        background-color: white;
        padding: 15px 45px;
        border-radius: 10px;
        width: fit-content;
    }
    .infBox{
        background-color: #ffffc0;
        padding: 3px 8px;
        border-radius: 10px;
        width: fit-content;
        display: inline-block;
        position: fixed;
        z-index: 2;
        left: 10;
        height: 6.7%;
    }
    .longWhite{
        width: 100%;
        height: 11%;
        background-color: white;
        position: fixed;
        z-index: 2;
        top: 7%;
        left:0;
    }
    .block{
        display: inline-block;
    }
    .container{
        align-items:flex-end;
    }
    .pageContainer{
        padding: 15px 45px;
    }
    ul{
        position: fixed;
        z-index: 3;
       box-shadow: none;
    }
</style>