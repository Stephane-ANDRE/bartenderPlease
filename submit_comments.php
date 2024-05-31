<?php
// Include form validation script to handle input data
require_once(__DIR__ . "/comments_form_validation.php"); 
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
<body>
    <div class="container">
        <!-- Include the site header -->
        <?php require_once(__DIR__ . "/header.php"); ?>

        <h1>Commentaire bien envoyé !</h1> 
        <div class="card">
            <div class="card-body">
                <p class="card-text"><b>Note</b> : <?php echo($review); ?> / 5</p>
                <p class="card-text"><b>Votre commentaire</b> : <?php echo strip_tags($comment); ?></p>
            </div>
        </div>
    </div>
    <!-- Include the site footer -->
    <?php require_once(__DIR__ . "/footer.php"); ?>
</body>
</html>
