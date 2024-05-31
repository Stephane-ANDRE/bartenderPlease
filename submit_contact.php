<?php
// Include form validation script to handle input data
require_once(__DIR__ . "/form_validation.php"); 
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
        <h1>Message bien reçu !</h1> 

        <!-- Display user input data in a Bootstrap card component -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <!-- Display submitted email -->
                <p class="card-text"><b>Email</b> : <?php echo(strip_tags($postData["email"])); ?></p> 
                <!-- Display submitted message -->
                <p class="card-text"><b>Message</b> : <?php echo(strip_tags($postData["message"])); ?></p>
                <?php if ($isFileLoaded) : ?>
                    <div class="alert alert-success" role="alert">
                        L'envoi a bien été effectué !
                    </div>
                <?php endif; ?> 
            </div>
        </div>
    </div>
    <!-- Include the site footer -->
    <?php require_once(__DIR__ . "/footer.php"); ?>
</body>
</html>
