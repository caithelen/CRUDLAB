<?php
// Escape function to sanitize inputs
function escape($value) {
    // Trim whitespace, convert special characters to HTML entities, and prevent XSS attacks
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// Other common functions, DB connection, etc. can go here
?>

