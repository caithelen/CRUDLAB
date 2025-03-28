 

<?php
/**
 * Configuration for database connection
 */

$host = "localhost";      
$username = "root";       
$password = "bKkd178830!";           
$dbname = "tests";         
$dsn = "mysql:host=$host;dbname=$dbname";  // DSN (Data Source Name)
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  // Enable exceptions for errors
);
?>
