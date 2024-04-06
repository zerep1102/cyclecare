<?php

// Check if the function is not already defined before defining it
if (!function_exists('test_input')) {
    // Function to sanitize input data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
