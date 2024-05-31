
<?php
require_once(__DIR__ . '/isConnect.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Cocktails</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<!-- Body with flexbox for full-height container -->
<body class="d-flex flex-column min-vh-100"> 
    <div class="container">
        <!-- Include the site header -->
        <?php require_once(__DIR__ . "/header.php"); ?>
        <h1>Mettre un commentaire</h1> 
        <!-- Contact form that submits data to 'submit_contact.php' using POST method -->
        <form action="/../submit_comments.php" method="POST" enctype="multipart/form-data"> 
        <div class="mb-3 visually-hidden">
        <input class="form-control" type="text" name="recipe_id" value="<?php echo($recipe['recipe_id']); ?>" />
        </div> 
            <div class="mb-3">
                <label for="review" class="form-label">Evaluez la recette (de 1 à 5)</label>
                <input type="number" class="form-control" id="review" name="review" min="1" max="5" step="1" />
            </div>         
            <!-- Form group for message textarea -->
            <div class="mb-3">
                <!--  Label and input for message  -->
                <label for="message" class="form-label">Postez votre commentaire</label> 
                <textarea class="form-control" placeholder="Exprimez vous tout en restant respecteux(se)" id="comment" name="comment"></textarea> 
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Envoyer</button> 
        </form>
        <br />
    </div>
    <!-- Include the site footer -->
    <?php require_once(__DIR__ . "/footer.php"); ?>
</body>

</html>
