<?php
    $server="localhost";
    $username="thekingc_purinto";
    $password="Tqs549_bc85";
    $database="thekingc_purintodb";

    // $server="localhost";
    // $username="root";
    // $password="";
    // $database="purinto_db";

    $con = mysqli_connect($server,$username,$password,$database);
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL cause by " . mysqli_connect_error();
    }
?>
