<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #f7f7f7;
    }

    div.content {
      margin-left: 20px;
      padding: 1px 16px;
    }

    .plus {
      background: -webkit-linear-gradient(180deg, #35B890 0%, #243E36 100%);
      background-clip: border-box;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .plus2 {
      background: #EFEFEF;
      border-radius: 65px;
      text-decoration: none;
      color: #243E36;
      padding: 10px;
    }

    .welcomeMsg {
      color: #243E36;
    }

    .button {
      background-color: #e83e19;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 10px;
    }

    .editBtn {
      border: none;
      background-color: #e9e9ed;
      text-decoration: none;
      cursor: pointer;
      border-radius: 10px;
      padding: 2%;
      color: #243E36;
    }

    hr {
      color: #243E36;
      border: 1px solid #243E36;
      border-radius: 5px;
    }

    .color {
      color: #243E36;
    }

    .card {
      transition: 0.3s;
      width: 30%;
      padding: 2%;
      background: #F1F1F1;
      border-radius: 38px;
      color: #243E36;
    }

    .card:hover {
      background-color: white
    }

    .container {
      padding: 2px 16px;
      display: flex;
      gap: 5px;
    }

    @media (max-width: 800px) {
  .container {
    flex-direction: column;
  }
  .card{
      width: 90%
  }
}

    .btn-grad-green {
      background-image: linear-gradient(to right, #145a32 0%, #27ae60 51%, #145a32 100%);
      margin: 10px;
      padding: 10px 10px;
      text-align: center;
      transition: 0.5s;
      background-size: 200% auto;
      color: white;
      box-shadow: 0 0 20px #eee;
      border-radius: 10px;
      display: block;
      border: none;
      width: fit-content;
      text-decoration: none;
    }

    .btn-grad-green:hover {
      background-position: right center;
      color: #fff;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <?php require('menu.php'); ?>


  <div class="content">





    <div id="listings">
      <h1 class="welcomeMsg">Welcome to PalletForest, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
      <h2 class="color">Your Listings</h2>
      <a class="plus2" href="lister.php">New Listing <i class="fa-solid fa-plus plus"></i></i></a>
      <br>
      <br>
      <div class="container">
        <?php
        $currListing = "";
        function getListings()
        {
          global $currListing;
          require_once "dbConfig.php";
          $ids = [];
          $user = strval($_SESSION["username"]);
          //echo $user;
          // Create connection
          $conn = new mysqli($servername, $username, $password);

          // Check connection
          if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
          } else {
            $retval = mysqli_select_db($conn, 'skrappap_palletforest');
            if (!$retval) {
              die('Could not select database: ' . mysqli_error($conn));
            }
          }

          $sql = "SELECT `id`, `title`, `loc`, `author`, `descr` FROM `listings` WHERE author='$user'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // get data of each row
            while ($row = $result->fetch_assoc()) {
              array_push($ids, $row["id"]);
              $currListing = $currListing . '
                          <div class="card">
                          <form action="edit.php" method="post">
                          <button class="editBtn" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                          <input readonly type="hidden" name="id" class="" value="'.$row["id"].'">
                          <input readonly type="hidden" name="title" class="" value="'.$row["title"].'">
                          <input readonly type="hidden" name="description" class="" value="'.$row["descr"].'">
                          <input readonly type="hidden" name="zip" class="" value="'.$row["loc"].'">
                          </form>
                          <h2>' . $row["title"] . '</h2>
                          <p>img</p>
                          <p>' . $row["loc"] . '</p>
                          </div><br>';
            }
          } else {
            echo "0 results";
          }

          $conn->close();
        }

        getListings();
        echo ($currListing);

        ?>
        <script type='text/javascript'>
          function editListing(selectedId, selectedTitle, selectedDescription, selectedZip) {
            console.log(selectedId + "" + selectedTitle + "" + selectedDescription + "" + selectedZip);
            var url = "/edit.php?id=" + selectedId + "&title=" + selectedTitle + "&description=" + selectedDescription + "&zip=" + selectedZip;
            window.open(url, '_self');
          }
        </script>


      </div>
      <p></p>
    </div>


    <div id="profile">
      <h2 class="color">Profile</h2>
      <h3 class="welcomeMsg"><?php echo htmlspecialchars($_SESSION["username"]); ?></h3>
      <a href="reset-password.php" class="button">Reset Your Password</a>
      <a href="logout.php" class="button">Sign Out</a>
      <br>
      <a href="deleteAccount.php" class="button">Request Account Deletion</a>
    </div>


    <div id="messages">
      <h2 class="color">Messages</h2>
      <a href="messages.php" class="btn-grad-green">View Your Messages</a>
    </div>


  </div>
  <br>
  <?php require('footer.php'); ?>

</body>

</html>