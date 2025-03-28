<?php
/**
* Delete a user
*/
require "../common.php";

// Initialize success message variable
$success = '';

if (isset($_GET["id"])) {
    try {
        // Include DB connection only once
        require_once '../src/DBconnect.php';

        $id = $_GET["id"];
        
        // Prepare SQL query to delete the user
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        // Set success message
        $success = "User " . $id . " successfully deleted";

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

// Fetch all users after deletion to refresh the table
try {
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

?>

<?php require "templates/header.php"; ?>

<h2>Delete users</h2>

<?php if ($success) echo "<p>$success</p>"; ?>

<table>
<thead>
<tr>
    <th>#</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email Address</th>
    <th>Age</th>
    <th>Location</th>
    <th>Date</th>
    <th>Delete</th>
</tr>
</thead>
<tbody>
<?php foreach ($result as $row) : ?>
<tr>
    <td><?php echo escape($row["id"]); ?></td>
    <td><?php echo escape($row["firstname"]); ?></td>
    <td><?php echo escape($row["lastname"]); ?></td>
    <td><?php echo escape($row["email"]); ?></td>
    <td><?php echo escape($row["age"]); ?></td>
    <td><?php echo escape($row["location"]); ?></td>
    <td><?php echo escape($row["date"]); ?></td>
    <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
