 
<?php
// Including the configuration file to fetch the database connection settings
include 'config.php';

try {
    // Creating the PDO connection object
    $connection = new PDO("mysql:host=$host", $username, $password, $options);

    // Set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the 'test' database if it doesn't exist
    $connection->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Database '$dbname' created successfully.<br>";

    // Switch to the test database
    $connection->exec("USE $dbname");

    // Create the 'users' table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        age INT(3),
        location VARCHAR(50),
        date TIMESTAMP
    )";
    
    // Execute the query to create the 'users' table
    $connection->exec($sql);
    echo "Table 'users' created successfully.";

} catch (PDOException $e) {
    // Handle connection or query errors
    echo "Connection failed: " . $e->getMessage();
}
?>
