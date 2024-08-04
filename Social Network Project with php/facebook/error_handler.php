<?php
// Define a custom error handler function
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    // Log the error or handle it in a way suitable for your application
    error_log("Error: $errstr in $errfile on line $errline");

    // Redirect to a default error page
    header('Location: error.php');
    exit;
}

// Set the custom error handler
set_error_handler('customErrorHandler');
