<!DOCTYPE html>
<html>
<title>Listings | PalletForest</title>

<body>
    <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet" />
    <link href="listings.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('menu.php'); ?>
    <div>
        <br>

        <center>

            <form action="listings.php" method="get">
                <input type="text" class="searchBox" name="zip" placeholder="Enter your zip code">
                <input type="hidden" value="15" name="rad">
                <button type="submit" class="searchBtn"><i class="fa-solid fa-magnifying-glass"></i> </button>
            </form>
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" class="radButt">Change Radius</button>

            <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="osm-map" class="map" width="30%"></div>
                    <input type="range" min="1" max="50" value="15" class="slider" id="range">
                    <p id="demo">Radius (miles): 15</p>
                    <button class="radButton" onclick="openRad()">Update Radius</button>

                    <br>
                </div>

            </div>

            <br>

            <?php
            if($_GET['zip'] == null){
                require('noListings.php');
            }
            else{
                echo ("<h2>Showing results for ");
            }

            $zip = preg_replace('/[^0-9\- ]/', '', $_GET['zip']);
            $servername = "50.87.221.65";
            $username = "skrappap_access";
            $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";


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
            $zip = preg_replace('/[^0-9\- ]/', '', $_GET['zip']);
            $sql = "SELECT * FROM zips WHERE zip=$zip";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["state"] != "NA") {
                        echo htmlspecialchars($row["primary_city"]) . ", " . htmlspecialchars($row["state"]);
                    } else {
                        echo htmlspecialchars($row["primary_city" . "</h2>"]);
                    }
                }
            }


            ?>
            </h2>
        </center>
        <p hidden id="zipcode"><?php echo htmlspecialchars(preg_replace('/[^0-9\- ]/', '', $_GET['zip']));?></p>
        <p hidden id="rad"><?php echo htmlspecialchars($_GET["rad"]); ?></p>
        <p hidden id="lat"><?php echo htmlspecialchars($lat2); ?></p>
        <p hidden id="long"><?php echo htmlspecialchars($long2); ?></p>
        <p hidden id="longData">
            <?php
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
            $zip = preg_replace('/[^0-9\- ]/', '', $_GET['zip']);
            $sql = "SELECT * FROM zips WHERE zip=$zip";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //echo $row["primary_city"];
                    $long = $row["longitude"];
                    echo htmlspecialchars($long);
                    //$lat = $row["latitude"];
                }
            }


            ?>
        </p>
        <p hidden id="latData">
            <?php

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
            $zip = preg_replace('/[^0-9\- ]/', '', $_GET['zip']);
            $sql = "SELECT * FROM zips WHERE zip=$zip";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //echo $row["primary_city"];
                    //$long = $row["longitude"];
                    $lat = $row["latitude"];
                    echo htmlspecialchars($lat);
                }
            }


            ?>
        </p>
    </div>
    <br>


    <div class="main">
        <div class="container" id="container">
            <?php
            $listing = $_GET['listing'];
            $radius = $_GET['rad'];
            $currListing = "";
            $listingOutput = "";
            $nearbyZips = [];
            $long2 = '';
            $lat2 = '';

            function nearbyZips()
            {
                $zip = preg_replace('/[^0-9\- ]/', '', $_GET['zip']);
                $servername = "50.87.221.65";
                $username = "skrappap_access";
                $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
                $long = '';
                $lat = '';
                global $nearbyZips;
                $rad = $_GET["rad"];
                global $long2;
                global $lat2;
                if ($rad == null) {
                    $rad = 15;
                }



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

                $sql = "SELECT * FROM zips WHERE zip=$zip";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //echo $row["primary_city"];
                        $long = $row["longitude"];
                        $lat = $row["latitude"];
                        $long2 = $row["longitude"];
                        $lat2 = $row["latitude"];
                    }
                }
                if ($rad != null) {
                    $sql = "SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($long) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance
                    FROM zips
                    HAVING distance < $rad;
                    ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //echo $row["primary_city"];
                            array_push($nearbyZips, $row['zip']);
                        }
                    }
                } else {
                    $sql = "SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($long) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance
                    FROM zips
                    HAVING distance < 15;
                    ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //echo $row["primary_city"];
                            array_push($nearbyZips, $row['zip']);
                        }
                    }
                }


                //echo $nearbyZips;
            }


            function getListings()
            {
                global $currListing;
                global $listing;
                $zip = preg_replace('/[^A-Za-z0-9\- ]/', '', $_GET['zip']);
                $servername = "50.87.221.65";
                $username = "skrappap_access";
                $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
                global $nearbyZips;
                require_once "dbConfig.php";
                $ids = [];
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
                $zip = preg_replace('/[^A-Za-z0-9\- ]/', '', $_GET['zip']);
                //echo($zip);
                //$sql="SELECT * FROM listings WHERE loc=$zip";
                $sql = "SELECT * FROM listings";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if (in_array($row["loc"], $nearbyZips)) {
                            //echo $row["id"];
                            array_push($ids, $row["id"]);

                            $currListing = $currListing . '
                                <div class="card" onclick="openListing(' . strval($row["id"]) . ')">
                                <center>
                                <img src="' . $row["img"] . '" class="img">
                                </center>
                                <h2>' . $row["title"] . '</h2>
                                <p class="locText">' . $row["loc"] . '</p>
                                </div><br>';
                        }
                    }
                } else {
                    echo "0 results";
                }


                echo ($currListing);
            }

            nearbyZips();
            getListings();


            ?>
        </div>

    </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <?php require('footer.php'); ?>
</body>



<script>
    var slider = document.getElementById("range");
    var output = document.getElementById("demo");
    var rad = (document.getElementById("rad")).innerHTML;

    function search() {
        var searchVal = (document.getElementById("searchBox")).value;
        var url = "https://palletforest.com/listings.php?zip=" + searchVal;
        if (/\s/.test(url)) {
            alert("Invalid Search. Space(s) detected.");
        } else if (/[a-zA-Z]/.test(searchVal)) {
            alert("Invalid Search. Non-numerical characters detected.");
        } else {
            window.open(url, '_self');
        }
    }

    function openListing(listing) {
        // alert(listing);
        var url = "https://palletforest.com/itm.php?listing=" + listing;
        window.open(url, '_self');
    }

    function contact(author, listing) {
        var url = "contact.php?listing=" + listing + "&author=" + author;
        window.open(url, '_self');
    }

    if (rad != null) {
        slider.value = rad;
        output.innerHTML = "Radius (miles): " + rad;
    } else {
        slider.value = 15;
    }

    slider.oninput = function() {
        output.innerHTML = "Radius (miles): " + this.value;
    }

    function openRad() {
        var rad = slider.value;
        var zip = (document.getElementById("zipcode")).innerHTML;
        var url = "listings.php?zip=" + zip + "&rad=" + rad;
        window.open(url, '_self');
    }


    var lat = (document.getElementById("latData")).innerHTML;
    var long = (document.getElementById("longData")).innerHTML;
    lat = parseFloat(lat);
    long = parseFloat(long);
    // Where you want to render the map.
    var element = document.getElementById('osm-map');

    // Height has to be set. You can do this in CSS too.
    element.style = 'height:300px;';
    //element.style = 'width:300px;';

    // Create Leaflet map on map element.
    var map = L.map(element);

    // Add OSM tile layer to the Leaflet map.
    L.tileLayer('https://tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Target's GPS coordinates.
    var target = L.latLng((lat), (long));
    //alert(lat + ", " + long);

    // Set map's center to target with zoom 14.


    // Place a marker on the same location.
    L.marker(target).addTo(map);
    L.circle([lat, long], (slider.value * 1609.34)).addTo(map);
    map.setView(target, 9);

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>