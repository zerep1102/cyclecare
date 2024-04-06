<?php
include 'connection.php';
include 'function.php';

// Your form processing code goes here

// Close the database connection (you can close it at the end of your main PHP file)
$conn->close();

?>

<?php

// Define variables and initialize with empty values
$username = $email = $password = $confirmPassword = "";
$userNameError = $emailError = $passwordError = $confirmPasswordError = "";

// Check if the form is submitted
if (isset($_POST["signup"])) {
    
    // Validate full name
    if (empty($_POST["username"])) {
        $userNameError = "Username is required";
    } else {
        $userName = test_input($_POST["username"]);
        // Check if full name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $userName)) {
            $userNameError = "Only letters and white space allowed";
        }
    }
    
    // Validate email
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }
    
    // Validate password
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // Password length validation could be added here
    }
    
    // Validate confirm password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordError = "Please confirm password";
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);
        if ($confirmPassword !== $password) {
            $confirmPasswordError = "Passwords do not match";
        }
    }

    // If no errors, process the form data further (e.g., store in database)
    if (empty($userNameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError)) {
        // Process the form data, for example, store it in a database
        // Here you can write code to store the form data into a database or perform any other required action
        // After successful processing, you can redirect the user to another page or show a success message
        // For simplicity, let's just print a success message here
        echo "Form submitted successfully!";
        // You can redirect to another page using header function if needed
        // header("Location: success.php");
        // exit();
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!-- HTML form goes here -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="field">
        <input type="text" placeholder="Username" name="username" id="username" required value="<?php echo $username; ?>">
        <p class="error" id="userNameError"><?php echo $userNameError; ?></p>
    </div>
    <div class="field">
        <input type="email" placeholder="Email Address" name="email" id="email" required value="<?php echo $email; ?>" >
        <p class="error" id="emailError"><?php echo $emailError; ?></p>
    </div>
    <div class="field">
        <input type="password" placeholder="Password" name="password" id="password" required value="<?php echo $password; ?>" >
        <p class="error" id="passwordError"><?php echo $passwordError; ?></p>
    </div>
    <div class="field">
        <input type="password" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" required>
        <p class="error" id="confirmPasswordError"><?php echo $confirmPasswordError; ?></p>
    </div>
    <div class="field btn">
        <div class="btn-layer"></div>
        <input type="submit" value="Signup" name="signup" id="signupButton">
    </div>
</form>

