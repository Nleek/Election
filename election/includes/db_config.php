<?php
/**
 * Auth: Lukas Yelle
 * Date: 10/31/16
 * Time: 1:40 AM
 */
    $host="localhost"; // Host name
    $username="bungle"; // Mysql username
    $password="L1nuxR0cks!"; // Mysql password
    $db_name="bungle_elect"; // Database name
    $connection = new mysqli("$host","$username","$password",$db_name)or die("cannot connect"); // <- This connection is for the updated SQL security patches.