<?php

function phpmotorsConnect()
{
    $server = 'localhost';
    $port = '3307';
    $dbname = 'phpmotor';
    $username = 'iClient';
    $password = '3gd3z2Ek76wxyW4c';
    $dsn = "mysql:host=$server:$port;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch (PDOException $e) {
        header("Location: ../views/500.php");
        exit;
    }
}
# testing the connect
phpmotorsConnect();
