<?php
// Include the common file which includes the DB connection and escape function
require "../common.php";

if (isset($_POST['submit'])) {
    try {
        // Include DB connection
        require_once '../src/DBconnect.php';

        // Prepare the new user data using escape() function to sanitize input
        $new_user = array(
            "firstname" => escape($_POST['firstname']),
            "lastname"  => escape($_POST['lastname']),
            "email"     => escape($_POST['email']),
            "age"       => escape($_POST['age']),
            "location"  => escape($_POST['location'])
        );

        // Build the INSERT SQL query dynamically
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        // Prepare and execute the query
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        // Check if the data was successfully inserted
        if ($statement->rowCount() > 0) {
            echo $new_user['firstname'] . ' successfully added';
        } else {
            echo "Something went wrong! Please try again.";
        }

    } catch(PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

require "templates/header.php";
?>

<h2>Add a user</h2>

<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" required>

    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" required>

    <label for="age">Age</label>
    <input type="number" name="age" id="age" required>

    <label for="location">Location</label>
    <input type="text" name="location" id="location" required>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>

