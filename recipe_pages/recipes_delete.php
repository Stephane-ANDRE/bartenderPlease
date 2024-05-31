<?php
session_start();  // Start the session to manage user data

require_once(__DIR__ . "/../isConnect.php");  // Include the file to check if the user is connected

/**
 * We do not process super globals directly from the user,
 * these data need to be tested and verified.
 */
$getData = $_GET;  // Retrieve data from the GET request

// Check if 'id' is set and if it is a numeric value
if (!isset($getData["id"]) || !is_numeric($getData["id"])) {
    echo("An identifier is required to delete the recipe.");  // Display an error message if 'id' is not valid
    return;  // Stop script execution
}
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
        
        <h1>Supprimez la recette?</h1>  <!-- Main heading for deleting a recipe -->
        <form action="recipes_post_delete.php" method="POST">  <!-- Form to submit the deletion request -->
            <div class="mb-3 visually-hidden">  <!-- Hidden input field for the recipe ID -->
                <label for="id" class="form-label">Recipe ID</label>  <!-- Label for the recipe ID -->
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getData["id"]; ?>">  <!-- Hidden input storing the recipe ID -->
            </div>

            <button type="submit" class="btn btn-danger">Attention suppression définitive</button>  <!-- Submit button with Bootstrap styling, warning about permanent deletion -->
        </form>
        <br />
    </div>

    <?php require_once(__DIR__ . "/../footer.php"); ?>  <!-- Include the site footer -->
</body>
</html>
