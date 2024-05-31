<?php
session_start();  // Start the session to manage user data

require_once(__DIR__ . "/../config/mysql.php");  // Include the MySQL configuration file
require_once(__DIR__ . "/../database_connect.php");  // Include the database connection file

/**
 * We do not process super globals directly from the user,
 * these data need to be tested and verified.
 */
$getData = $_GET;  // Retrieve data from the GET request

// Check if 'id' is set and if it is a numeric value
if (!isset($getData["id"]) || !is_numeric($getData["id"])) {
    echo("The recipe does not exist");  // Display an error message if 'id' is not valid
    return;  // Stop script execution
}

// Retrieve all comments for the recipe
$retrieveRecipeWithCommentsStatement = $mysqlClient->prepare("SELECT r.*, c.comment_id, c.comment, c.user_id, DATE_FORMAT(c.created_at, '%d/%m/%Y') as comment_date, u.full_name FROM recipes r 
LEFT JOIN comments c on c.recipe_id = r.recipe_id
LEFT JOIN users u ON u.user_id = c.user_id
WHERE r.recipe_id = :id 
ORDER BY comment_date DESC");  // Prepare the SQL query
$retrieveRecipeWithCommentsStatement->execute([
    "id" => (int)$getData["id"],  // Bind the 'id' parameter
]);
$recipeWithComments = $retrieveRecipeWithCommentsStatement->fetchAll(PDO::FETCH_ASSOC);  // Fetch all results

// Check if the recipe exists
if ($recipeWithComments === []) {
    echo("The recipe does not exist");  // Display an error message if no recipe is found
    return;  // Stop script execution
}

// Retrieve the average rating for the recipe
$retrieveAverageRatingStatement = $mysqlClient->prepare("SELECT ROUND(AVG(c.review), 1) as rating FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = :id");
$retrieveAverageRatingStatement->execute([
    "id" => (int)$getData["id"],  // Bind the 'id' parameter
]);
$averageRating = $retrieveAverageRatingStatement->fetch();  // Fetch the average rating

// Initialize the recipe array with details and comments
$recipe = [
    "recipe_id" => $recipeWithComments[0]["recipe_id"],
    "title" => $recipeWithComments[0]["title"],
    "recipe" => $recipeWithComments[0]["recipe"],
    "author" => $recipeWithComments[0]["author"],
    "comments" => [],
    "rating" => $averageRating["rating"],
];

// Populate the comments array for the recipe
foreach ($recipeWithComments as $comment) {
    if (!is_null($comment["comment_id"])) {
        $recipe["comments"][] = [
            "comment_id" => $comment["comment_id"],
            "comment" => $comment["comment"],
            "user_id" => (int) $comment["user_id"],
            "full_name" => $comment["full_name"],
            "created_at" => $comment["comment_date"],
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  <!-- Set the character encoding to UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- Ensure compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Make the page responsive -->
    <title>Cocktails <?php echo($recipe["title"]); ?></title>  <!-- Title of the page -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >  <!-- Include Bootstrap CSS for styling -->
</head>
<body class="d-flex flex-column min-vh-100">  <!-- Use flexbox for full-height container -->
    <div class="container">  <!-- Container class for Bootstrap styling -->

        <?php require_once(__DIR__ . "/../header.php"); ?>  <!-- Include the site header -->
        
        <h1><?php echo($recipe["title"]); ?></h1>  <!-- Display the recipe title -->
        <div class="row">
            <article class="col">
                <?php echo($recipe["recipe"]); ?>  <!-- Display the recipe content -->
            </article>
            <aside class="col">
                <p>
                    <i>Proposée par <?php echo($recipe["author"]); ?></i>  <!-- Display the author's name -->
                </p>
                <?php if ($recipe["rating"] !== null) : ?>
                    <p>
                        <b>Evalué par la communauté <?php echo($recipe["rating"]); ?> / 5</b>  <!-- Display the average rating if available -->
                    </p>
                <?php else : ?>
                    <p>
                        <b>Pas de note</b>  <!-- Display a message if no rating is available -->
                    </p>
                <?php endif; ?>
            </aside>
        </div>
        <hr />
        <h2>Commentaires</h2>  <!-- Section for comments -->
        <?php if ($recipe["comments"] !== []) : ?>
        <div class="row">
            <?php foreach ($recipe["comments"] as $comment) : ?>
                <div class="comment">
                    <p><?php echo($comment["created_at"]); ?></p>  <!-- Display the comment date -->
                    <p><?php echo $comment["comment"]; ?></p>  <!-- Display the comment content -->
                    <i>(<?php echo $comment["full_name"]; ?>)</i>  <!-- Display the commenter's full name -->
                </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="row">
            <p>Aucun commentaire</p>  <!-- Display a message if no comments are available -->
        </div>
        <?php endif; ?>
        <hr />
        <?php if (isset($_SESSION["LOGGED_USER"])) : ?>
            <?php require_once(__DIR__ . "/../comments.php"); ?>  <!-- Include the comments form if the user is logged in -->
        <?php endif; ?>
    </div>
    <?php require_once(__DIR__ . "/../footer.php"); ?>  <!-- Include the site footer -->
</body>
</html>
