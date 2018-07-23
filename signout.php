<?php
/**
 * Created by PhpStorm.
 * User: Beyarz
 * Date: 2018-05-24
 * Time: 00:43
 */

session_start();

setcookie("uid", "", time() -10);
setcookie("user", "", time() -10);
setcookie("useragent", "", time() -10);
setcookie("publicip", "", time() -10);

unset($_COOKIE["uid"]);
unset($_COOKIE["user"]);
unset($_COOKIE["useragent"]);
unset($_COOKIE["publicip"]);

session_destroy();

header("location: index.php");