<?php
/**
 * Created by PhpStorm.
 * User: Beyarz
 * Date: 2018-05-24
 * Time: 00:39
 */

session_start();
include("config.php");

if(isset($_COOKIE["user"])){

    // Checks if the uid is the same as user
    $testSubject = $_COOKIE["uid"];
    $sqlQuery = "SELECT $col2, $col3 FROM $databasename.$tablename WHERE $col2 = '$testSubject'";
    $connect = new mysqli($databasehost, $dbuser, $dbpassword);
    $request = mysqli_query($connect, $sqlQuery);
    while ($response = mysqli_fetch_array($request)){
        if($response[$col2] == $testSubject) {
            $uid = $_COOKIE["uid"];
            $user = $_COOKIE["user"];
        }
    }

    // If zero results then fake user
    if ($rows = mysqli_num_rows($request) == 0){
        header("location: signout.php");
    }

} else{
    header("location: index.php");
}

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
            <a href="signout.php" class="item">Log out</a>
            <div class="right menu">
                <p class="ui item">
                    ID:  <?php echo $uid ?>
                </p>
            </div>
        </div>

        <!-- Background image with title -->
        <div class="ui segment" style="border: none;padding: 0;margin: 0;">
            <div class="ui active dimmer" style="padding: 0;">
                <div class="title-logo">
                    <p style="color: white; font-size: 28px;">Welcome home <?php echo $user ?>!</p>
                    <div class="ui left icon input focus full-width">
                        <input type="text" placeholder="No function yet...">
                        <i class="angle right icon"></i>
                    </div>
                </div>
            </div>
            <img src="media/background.jpg" height="650px" width="100%">
        </div>

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