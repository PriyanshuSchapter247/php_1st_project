
<?php
$hostname="localhost";
$username="root";
$password="";
$db="ui";

$conn= new mysqli($hostname,$username,$password,$db);
if($conn->connect_error)
{
    echo $conn->connect_error;
}


