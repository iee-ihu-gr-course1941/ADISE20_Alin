<?php
$DB_SERVER ="localhost";
$define ="root";
$DB_PASSWORD= "";
$DB_NAME = "alin";

$conn = mysqli_connect($DB_SERVER, $define, $DB_PASSWORD, $DB_NAME);

if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
