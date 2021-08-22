<?php
    $user_name = "root";
    $p = "";
    $database = "placenevents";
    $host_name = "localhost";
    $con = mysqli_connect($host_name ,$user_name ,$p,$database) or die("Ошибка при подключении к базе данных " . mysqli_error($con));
?>