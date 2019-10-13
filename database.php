<?php
/**
 * Created by PhpStorm.
 * User: Beyar
 * Date: 2018-05-23
 * Time: 21:56
 */

// Create database
function createdb() {

    // Including default credentials
    include("config.php");

    // Open connection & deliver query
    $sqlQuery = "CREATE DATABASE $databasename";
    $connect = new mysqli($databasehost, $dbuser, $dbpassword);
    $connect->query($sqlQuery);

    // Checks for what happened
    if ($connect->error) {
        if($connect->error == "Can't create database '$databasename'; database exists") {
            echo "Database successfully created.</br>";
        } else {
            echo "<span>Connection failed: " . $connect->error . "</span></br>";
        }
    } else {
        echo "Database successfully created.</br>";
    }

    // Closes the connection
    $connect->close();
}

// Create table
function createtb() {

    // Including default credentials
    include("config.php");

    // Repeat for table
    $sqlQuery2 = "CREATE TABLE $databasename.$tablename ($col1 INT AUTO_INCREMENT PRIMARY KEY NOT NULL, $col2 TEXT NOT NULL, $col3 TEXT NOT NULL, $col4 TEXT NOT NULL, $col5 TEXT NOT NULL, $col6 TEXT NOT NULL, $col7 TEXT NOT NULL, $col8 TIMESTAMP)";
    $connect = new mysqli($databasehost, $dbuser, $dbpassword);
    $connect->query($sqlQuery2);

    // Checks for what happened
    if ($connect->error) {
        if($connect->error == "Table '$tablename' already exists") {
            echo "Table successfully created.</br>";
        } else {
            echo "<span>Connection failed: " . $connect->error . "</span></br>";
        }
    } else {
        echo "Table successfully created.</br>";
    }

    // Closes the connection
    $connect->close();
}

// Creating database
createdb();

// Creating table
createtb();

