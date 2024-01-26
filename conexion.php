<?php
    $_HOST_NAME = 'localhost';
    $_DATABASE_NAME = 'u';
    $_DATABASE_USER_NAME = 'u';
    $_DATABASE_PASSWORD = 'T';

    $conn = new MySQLi($_HOST_NAME,  $_DATABASE_USER_NAME, $_DATABASE_PASSWORD,  $_DATABASE_NAME);

    if(!$conn)
    {
        die("Conexión fallida : ".mysqli_connect_error());
    }

    //echo "Conexión satisfactoria";

$conn->set_charset("utf8"); 
