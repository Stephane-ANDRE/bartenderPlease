<?php
session_start(); // Start the session

// Include necessary files
require_once(__DIR__ . '/../isConnect.php');
require_once(__DIR__ . '/../config/mysql.php');
require_once(__DIR__ . '/../database_connect.php');

// Get POST data
$postData = $_POST;

// Validate the data
if (
    !isset($postData['id']) // Check if 'id' is set
    || !is_numeric($postData['id']) // Check if 'id' is numeric
    || empty($postData['title']) // Check if 'title' is empty
    || empty($postData['recipe']) // Check if 'recipe' is empty
    || trim(strip_tags($postData['title'])) === '' // Check if 'title' is empty after trimming and stripping tags
    || trim(strip_tags($postData['recipe'])) === '' // Check if 'recipe' is empty after trimming and stripping tags
) {
    echo 'Missing information to edit the form.'; // Output error message
    return; // Exit the script
}

// Sanitize and cast the data
$id = (int)$postData['id']; // Cast 'id' to integer
$title = trim(strip_tags($postData['title'])); // Sanitize 'title'
$recipe = trim(strip_tags($postData['recipe'])); // Sanitize 'recipe'

// Prepare and execute the update statement
$insertRecipeStatement = $mysqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');
$insertRecipeStatement->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id,
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktails</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/../header.php'); // Include the header ?>
        <h1>Vous avez modifié la recette</h1>

        <div class="card">

            <div class="card-body">
                <h5 class="card-title"><?php echo($title); ?></h5> <!-- Display the title -->
                <p class="card-text"><b>Email</b> : <?php echo $_SESSION['LOGGED_USER']['email']; ?></p> <!-- Display the user's email -->
                <p class="card-text"><b>Recette</b> : <?php echo $recipe; ?></p> <!-- Display the recipe -->
            </div>
        </div>
    </div>
    <?php require_once(__DIR__ . '/../footer.php'); // Include the footer ?>
</body>
</html>
