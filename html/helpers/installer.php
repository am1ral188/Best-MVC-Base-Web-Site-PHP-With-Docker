<?php

$servername = DB_HOST;

$username = DB_USER;

$password = DB_PASS;

$dbname = DB_NAME;

// Create connection

$conn = new mysqli($servername, $username, $password);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

// Create database

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql) === TRUE) {

//    echo "Database created successfully\n";

} else {

    echo "Error creating database: " . $conn->error . "\n";

}

// Select database

$conn->select_db($dbname);
$Path = SAVE_IMAGE_PATH;
// Create table

$sql = "CREATE TABLE IF NOT EXISTS users (

username varchar (250)  PRIMARY KEY,

`pass` VARCHAR(250) NOT NULL,

acs VARCHAR(30) NOT NULL,

profile_image TEXT DEFAULT " . $Path ."default_img.png". ";

)";
if ($conn->query($sql) === TRUE) {

//    echo "Table MyGuests created successfully\n";

} else {

    echo "Error creating table: " . $conn->error . "\n";

}

// Insert row

$sql = "INSERT INTO users (username, pass, acs)

VALUES ('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997a5c2f8f5dd13697f9b9c3​e​be', 'admin')";

if ($conn->query($sql) === TRUE) {

//    echo "New record created successfully\n";

} else {

    echo "Error: " . $sql . "<br>" . $conn->error . "\n";

}

$conn->close();

?>