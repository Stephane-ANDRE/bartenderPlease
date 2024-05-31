<?php
session_start(); // Start the session

// Include necessary files
require_once(__DIR__ . "/isConnect.php");
require_once(__DIR__ . "/config/mysql.php");
require_once(__DIR__ . "/database_connect.php");

// Get POST data
$postData = $_POST;

// Validate the data
if (
    !isset($postData["comment"]) || // Check if 'comment' is set
    !isset($postData["recipe_id"]) || // Check if 'recipe_id' is set
    !is_numeric($postData["recipe_id"])|| // Check if 'recipe_id' is numeric
    !is_numeric($postData["review"]) // Check if 'review' is numeric
) {
    echo("The comment and/or rating are invalid."); // Output error message
    return; // Exit the script
}

// Sanitize and cast the data
$comment = trim(strip_tags($postData["comment"])); // Sanitize 'comment'
$recipeId = (int)$postData["recipe_id"]; // Cast 'recipe_id' to integer
$review = (int)$postData["review"]; // Cast 'review' to integer

// Validate the review rating
if ($review < 1 || $review > 5) { // Check if 'review' is between 1 and 5
    echo "The rating must be between 1 and 5"; // Output error message
    return; // Exit the script
}
if ($comment === "") { // Check if 'comment' is empty
    echo "The comment cannot be empty."; // Output error message
    return; // Exit the script
}

// Prepare and execute the insert statement
$insertRecipe = $mysqlClient->prepare("INSERT INTO comments(comment, recipe_id, user_id, review) VALUES (:comment, :recipe_id, :user_id, :review)");
$insertRecipe->execute([
    "comment" => $comment, // Bind 'comment'
    "recipe_id" => $recipeId, // Bind 'recipe_id'
    "user_id" => $_SESSION["LOGGED_USER"]["user_id"], // Bind 'user_id' from session
    "review" => $review, // Bind 'review'
]);

?>
