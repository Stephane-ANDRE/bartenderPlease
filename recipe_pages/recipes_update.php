<?php
session_start();  // Start the session to manage user data

require_once(__DIR__ . "/../isConnect.php");  // Include the connection verification file
require_once(__DIR__ . "/../config/mysql.php");  // Include the MySQL configuration file
require_once(__DIR__ . "/../database_connect.php");  // Include the database connection file

/**
 * We do not process super globals directly from the user,
 * these data need to be tested and verified.
 */
$getData = $_GET;  // Retrieve data from the GET request

// Check if 'id' is set and if it is a numeric value
if (!isset($getData["id"]) || !is_numeric($getData["id"])) {
    echo("A recipe ID is required to modify it.");  // Display an error message if 'id' is not valid
    return;  // Stop script execution
}

$retrieveRecipeStatement = $mysqlClient->prepare("SELECT * FROM recipes WHERE recipe_id = :id");  // Prepare the SQL query to retrieve the recipe
$retrieveRecipeStatement->execute([
    "id" => (int)$getData["id"],  // Bind the 'id' parameter
]);
$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);  // Fetch the recipe data

// if the recipe is not found, return an error message
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  <!-- Set the character encoding to UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- Ensure compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Make the page responsive -->
    <title>Recipe Site</title>  <!-- Title of the page -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >  <!-- Include Bootstrap CSS for styling -->
</head>
<body class="d-flex flex-column min-vh-100">  <!-- Use flexbox for full-height container -->
    <div class="container">  <!-- Container class for Bootstrap styling -->

        <?php require_once(__DIR__ . "/../header.php"); ?>  <!-- Include the site header -->
        <h1>Update <?php echo($recipe['title']); ?></h1>  <!-- Display the recipe title -->
        <form action="recipes_post_update.php" method="POST">  <!-- Form to update the recipe -->
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Recipe ID</label>  <!-- Hidden input for recipe ID -->
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData["id"]); ?>">  <!-- Hidden input field -->
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>  <!-- Label for the title input -->
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($recipe["title"]); ?>">  <!-- Input field for the title with existing value -->
                <div id="title-help" class="form-text">Choisi un titre classe !</div>  <!-- Help text for the title input -->
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette/label>  <!-- Label for the description textarea -->
                <textarea class="form-control" placeholder="Describe the recipe in a few steps" id="recipe" name="recipe"><?php echo $recipe["recipe"]; ?></textarea>  <!-- Textarea for the recipe description with existing value -->
            </div>
            <button type="submit" class="btn btn-primary">Envoyez</button>  <!-- Submit button for the form -->
        </form>
        <br />
    </div>

    <?php require_once(__DIR__ . "/../footer.php"); ?>  <!-- Include the site footer -->
</body>
</html>
