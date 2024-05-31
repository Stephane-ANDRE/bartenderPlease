<?php
session_start();  // Start the session to handle user data

require_once(__DIR__ . "/../isConnect.php");  // Include the file that checks if the user is connected
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  <!-- Set the character encoding to UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- Ensure compatibility with Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Make the page responsive -->
    <title>Cocktails</title>  <!-- Title of the page -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >  <!-- Include Bootstrap CSS for styling -->
</head>
<body class="d-flex flex-column min-vh-100">  <!-- Use flexbox for full-height container -->
    <div class="container">  <!-- Container class for Bootstrap styling -->

        <?php require_once(__DIR__ . "/../header.php"); ?>  <!-- Include the site header -->

        <h1>Ajouter une recette</h1>  <!-- Main heading for adding a recipe -->
        <form action="/../recipe_submits/recipe_post_create.php" method="POST">  <!-- Form to submit a new recipe -->
            <div class="mb-3">  <!-- Bootstrap class for margin bottom spacing -->
                <label for="title" class="form-label">Titre de la recette</label>  <!-- Label for the recipe title -->
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">  <!-- Input field for the recipe title -->
                <div id="title-help" class="form-text">Choisissez un titre percutant !</div>  <!-- Help text for the title input -->
            </div>
            <div class="mb-3">  <!-- Bootstrap class for margin bottom spacing -->
                <label for="recipe" class="form-label">Description de la recette</label>  <!-- Label for the recipe description -->
                <textarea class="form-control" placeholder="Décrivez la recette en quelques étapes" id="recipe" name="recipe"></textarea>  <!-- Textarea for the recipe description -->
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>  <!-- Submit button with Bootstrap styling -->
        </form>
    </div>

    <?php require_once(__DIR__ . "/../footer.php"); ?>  <!-- Include the site footer -->
</body>
</html>
