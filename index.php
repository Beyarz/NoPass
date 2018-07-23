<?php
/*
 * Created by PhpStorm.
 * User: Beyarz
 * Date: 2018-05-20
 * Time: 19:11
 */

session_start();

include("config.php");

// Unique identifier
if($_COOKIE["uid"] == null) {

    $uid = substr(hash("sha256", rand(0, 999999)), 0, 10);
    setcookie("uid", $uid);

    $publicip = $_SERVER['REMOTE_ADDR'];
    setcookie("publicip", $publicip);

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    setcookie("useragent", $useragent);

    header("location: index.php");
}

// Checks if user already logged in once
$find = $_COOKIE["uid"];
$sqlQuery = "SELECT $col2, $col3 FROM $databasename.$tablename WHERE $col2 = '$find'";
$connect = new mysqli($databasehost, $dbuser, $dbpassword);
$request = mysqli_query($connect, $sqlQuery);
while ($response = mysqli_fetch_array($request)){
    if($response[$col2] == $find) {
        setcookie("user", $response[$col3]);
        header("location: home.php");
    }
}
echo $connect->error;
$connect->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title & icon -->
        <title>NoPass | Project</title>
        <link rel="shortcut icon" type="image/jpg" href="media/icon.jpg" alt="icon" />

        <!-- Javascript through CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" integrity="sha256-oDCP2dNW17Y1QhBwQ+u2kLaKxoauWvIGks3a4as9QKs=" crossorigin="anonymous" />

        <!-- Unnecessary SEO tags -->
        <meta name="robots" content="index, follow">
        <meta name="geo.placename" content="Sweden, stockholm">

        <!-- Necessary SEO tags -->
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="description" content="A website with an new and revolutionary design, reconstructing the idea
        with authentication and defining the fundamentals such as username & password." />


    </head>
    <body style="background-color: #353B43;">

        <!-- Navbar -->
        <div class="ui secondary inverted pointing menu" style="background-color: #1D2024;padding: 1%;font-size: 16px;margin-bottom: 0%;">
            <a class="active item">Index</a>
            <a class="item" href="down.php">Verify</a>
            <div class="right menu">
                <p class="ui item">
                    ID:  <?php echo $_COOKIE["uid"]; ?>
                </p>
            </div>
        </div>

        <!-- Background image with title -->
        <div class="ui segment" style="border: none;padding: 0;margin: 0;">
            <div class="ui active dimmer" style="padding: 0;">
                <div class="title-logo">
                    <p style="color: white; font-size: 28px;">A place where password isn't required!</p>
                    <br>
                    <a href="down.php">
                        <button class="ui basic inverted button" id="verify-button">Verify yourself</button>
                    </a>
                </div>
            </div>
            <img src="media/background.jpg" height="650px" width="100%">
        </div>

        <!-- Space between background & cards -->
        <div style="background-color: #262626;padding: 1%;"></div>
        <div class="container" style="padding-top: 3%;">
            <div class="center aligned content">
                <h1 class="header" style="color:white;text-align:center;text-decoration:underline;text-decoration-color:#5CCBCB;">About the project</h1>
            </div>
        </div>

        <!-- Column grid -->
        <div class="ui three column stackable grid container" style="padding: 5%;padding-bottom: 0%;width: 100%;">

            <!-- First column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Stable</div>
                        <div class="image">
                            <img src="media/stable.svg" alt="Stable" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>I recommend you don't fire until you're within 40,000 kilometers. You did exactly what you had to do.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Portable</div>
                        <div class="image">
                            <img src="media/portable.svg" alt="Portable" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it?</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Efficient</div>
                        <div class="image">
                            <img src="media/efficient.svg" alt="Efficient" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>Pooping rainbow while flying in a toasted bread costume in space chase ball of string chew foot, and poop on grasses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column grid -->
        <div class="ui three column stackable grid container" style="padding: 5%;width: 100%;">

            <!-- First column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Optimized</div>
                        <div class="image">
                            <img src="media/optimized.svg" alt="Optimized" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>Gingerbread cake jelly pudding jelly beans. Fruitcake gingerbread wafer wafer gingerbread apple pie marshmallow. Cupcake caramels biscuit macaroon.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Security</div>
                        <div class="image">
                            <img src="media/strong-security.svg" alt="Security" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>Introvert jazz cafes having a few beers self-deprecating humor. Degree in philosophy Vampire Weekend introvert self-deprecating humor really hoppy beers.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third column -->
            <div class="column">
                <div class="ui fluid black card" style="background-color: #252930;">
                    <div class="center aligned content">
                        <div class="header" style="color: #AFBAC4;">Professionals</div>
                        <div class="image">
                            <img src="media/professionals.svg" alt="Professionals" width="64" height="64">
                        </div>
                        <div class="description" style="color: #737F89;">
                            <p>Hotdog systema plastic tanto concrete car refrigerator kanji physical sprawl geodesic singularity kanji. gang franchise pen cartel monofilament network tank-traps.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Space between Columns & Quote -->
        <div class="container">
            <div class="center aligned content">
                <h1 class="header" style="color:white;text-align:center;text-decoration:underline;text-decoration-color:#5CCBCB;">Quote</h1>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container" align="center">
                <h1 class="header" style="color: white;font-style: italic;font-family: Helvetica Neue Light;">
                    <p>"Meditation chillwave subway tile cloud bread,</br>
                        celiac four loko freegan. Intelligentsia squid la croix,</br>
                        cray four dollar toast kogi tattooed pork belly,</br>
                        before they sold out poke gastropub twee selfies."
                    </p>
                </h1>
            </div>
        </div>

        <!-- Space between Quote & footer -->
        <div class="container" style="padding-top: 3%;"></div>

        <!-- Footer -->
        <div class="ui inverted vertical footer segment">
            <div class="ui container">
                <div class="ui inverted">
                    <div class="ui center aligned container">
                        <p>Made with ❤️ by <a href="#">Beyar N</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script>
            $(".title-logo")
                .transition({
                    animation: "fade in",
                    duration: 3500,
                    reverse: "auto"
                });
            $("#verify-button").click(function(){
                $("#verify-button").addClass("loading");
            })
        </script>

    </body>
</html>