<?php
include_once 'function.php';
?>

<?php


// Database configuration
$servername = "localhost";
$username = "username";
$email = "email";
$password = "password";
$database = "cyclecareDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST["signup"])) {
    // Define variables and initialize with form data
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Hash the password before storing it in the database for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the insert statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}



// Close the database connection
$conn->close();

?>
