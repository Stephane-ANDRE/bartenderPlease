<?php
// Start the session if it hasn't been started already
session_start(); 

require_once(__DIR__ . '/functions.php');

// Destroy the session:
// Unset all session variables
session_unset(); 
// Destroy the session itself
session_destroy(); 

// Redirect the user to the homepage
// Function to handle the redirection
redirectToUrl('index.php'); 
