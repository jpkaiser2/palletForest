<!DOCTYPE html>
<html>
<title>PalletForest</title>
<body>
    <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php require('menu.php');?>

    <div class="topBox">
        <br>
        <b><h1 class="xxl">PalletForest</h1></b>
        <br> 
        <br>
        <form action="listings.php" method="get">
            <input type="text" class="searchBox" name="zip" placeholder="Enter your zip code here">
            <button type="submit" class="searchBtn"><i class="fa-solid fa-magnifying-glass"></i> </button>
        </form>

           
            <br>
            <br>
            <br>
            <br>
            <br>
            
    </div>
        <br>
        <br>
  
        
     

        <div class="content">
            <h1 class="color">Get pallets for your projects, 100% free.</h1>
            <p>PalletForest enables woodworkers and hobbyists to get free wood for their projects from unwanted shipping pallets.</p>
            <br>
            <img src="logo2.png" width='40%'>
            <br>
            <h1 class="color">How it Works</h1>
            
            <div class="row">
                <div class="column2 left">
                    <h2>Businesses list pallets.</h2>
                    <p>First, someone lists a pallet they don’t want or need anymore. Individuals as well as businesses can list pallets. PalletForest is especially beneficial to businesses because they don’t have to pay for pallet removal services. Businesses that frequently need to dispose of pallets may make one listing for all of them.</p>
                </div>
                <div class="column2 middle">
                    <h2>Woodworkers and hobbyists pick up the pallets.</h2>
                    <p>Second, woodworkers and hobbyists like you can go pick up the pallets. Some listers may give their address and allow you to come at any time, while others may want you to message them first. If you are unsure what the lister wants you to do, we encourage you to message them. When picking up pallets, make sure you are kind to the lister and follow our terms of service. We recommend lining your car with plastic before you pick up pallets, as most pallets are dirty.</p>
                    <br>
                </div>
                <div class="column2 right">
                    <h2>Free wood for woodworking.</h2>
                    <p>Third, build something! Pallet wood is a great, free way to get started in woodworking. You can create chairs, tables, garden beds, the possibilities are endless!</p>
                </div>
            </div>
            <h1 class="color">Get Started Now</h1>
            <center>
            <div class="row">
                <div class="column">
                    <a class="btn-grad-green" href="register.php">Sign up</a>
                    <br>
                </div>
                <div class="column">
                    <img draggable="false" src="phoneImg1.png" width="50%">
                </div>
            </div>
            <center>
                <br>
                <a href="https://www.facebook.com/palletforest" target="_blank"><i class="fa fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/pallet.forest/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.pinterest.com/palletforest/" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
        </div>
        <?php require('footer.php');?>

</body>
</html>

<script>

    function search(){
        var searchVal = (document.getElementById("searchBox")).value;
        var url = "listings.php?zip=" + searchVal;
        if(/\s/.test(url)){
            alert("Invalid Search. Space(s) detected.");
        }
        else if(/[a-zA-Z]/.test(searchVal)){
            alert("Invalid Search. Non-numerical characters detected.");
        }
        else{
            window.open(url, '_self');
        }
    }
  

</script>

<style>
    .fa{
        background-color:#243E36;
    }
    .fa:hover{
        cursor: pointer;
        background-color:#145a32;
    }
    * {
  box-sizing: border-box;
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
        width: 75%;
        text-decoration: none;
    }

    .btn-grad-green:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }
    body{
        padding: 0; 
        margin: 0;
        background-color: #f7f7f7;
        font-family: 'Nunito', sans-serif;
    }
    
    .topBox{
        background-color: #243E36;
        color: white;
        padding: 10px;
        background-image: url("bg.png");
        background-repeat: no-repeat;
        background-size: cover;
    }
    @media screen and (max-width: 599px) {
        .xxl{
            font-size: 60px;
        }
        .searchBox {
        width: 80%;
        border: none;
        border-right: none;
        padding: 10px;
        height: 30%;
        border-radius: 30px 0 0 30px;
        outline: none;
        color: #a6a6a6;
        background-color: white;
        font-size: large;
        }


        .searchBtn {
            width: 15%;
            border: none;
            border-right: none;
            padding: 10px;
            height: 30%;
            border-radius: 0 30px 30px 0;
            outline: none;
            color: #a6a6a6;
            background-color: white;
            font-size: large;
            cursor: pointer;
        }
        .left, .right, .middle, .row2, .column2 {
        background-color:#f7f7f7;
        }

    }



    @media only screen and (min-width: 600px) {
        /* Create two equal columns that floats next to each other */
        .column {
        float: left;
        width: 50%;
        padding: 10px;
        }
        /* Create three unequal columns that floats next to each other */
        .column2 {
        float: left;
        padding: 10px;
        height: 400px; 
        }
        .left, .right {
        width: 33.3333%;
        background-color:#dedede;
        }

        .middle {
        width: 33.3333%;
        background-color:#ececec;
        }

        /* Clear floats after the columns */
        .row2:after {
        content: "";
        display: table;
        clear: both;
        }
        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
        .xxl{
            font-size: 80px;
        }
        .searchBox {
        width: 60%;
        border: none;
        border-right: none;
        padding: 10px;
        height: 30%;
        border-radius: 30px 0 0 30px;
        outline: none;
        color: #a6a6a6;
        background-color: white;
        font-size: large;
        }
        .searchBtn {
            width: 5%;
            border: none;
            border-right: none;
            padding: 10px;
            height: 30%;
            border-radius: 0 30px 30px 0;
            outline: none;
            color: #a6a6a6;
            background-color: white;
            font-size: large;
            cursor: pointer;
        }
    }

    
    .centerDiv{
        display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .content{
        margin: 10px;
        
    }
    .color{
        color: #243E36;
    }
    h1{
        font-size: 40px;
    }

    textarea{
        width: 33.4%;
        height: 40px;
        box-sizing: border-box;
        border: none;
        border-radius: 4px;
        background-color: #f7f7f7;
        font-size: 16px;
        resize: none;
    }



    .wrap{
        width: 40%;
        text-align: center;
        border: 3px solid white;
        border-radius: 5px 5px 5px 5px;
    }
   .fa:hover{
    background-color: #243E36;
    cursor: pointer;
   }
    
    </style>


