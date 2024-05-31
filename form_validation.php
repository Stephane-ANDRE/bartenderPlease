<?php

// Capture POST data from the form submission
$postData = $_POST;

// Validate form data
if (
    // Check if email is set
    !isset($postData["email"])
    // Validate email format 
    || !filter_var($postData["email"], FILTER_VALIDATE_EMAIL)
    // Check if message is not empty 
    || empty($postData["message"])
    // Ensure message is not just whitespace 
    || trim($postData["message"]) === "" 
) {
    // Display an error message if validation fails
    echo("Il faut un email et un message valides pour soumettre le formulaire.");
    // Stop script execution if validation fails
    return; 
}
$isFileLoaded = false;
    //Checking if the file has been sent and there is no error
if(
isset($_FILES["screenshot"]) && $_FILES["screenshot"]["error"] == 0) 
    {
         // Checking if the files is not too big
    if ($_FILES["screenshot"]["size"] > 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse (moins d'1mo)";
        return;
    }
    }
     // Checking if the extension is ok or not
     $fileInfo = pathinfo($_FILES["screenshot"]["name"]);
     $extension = $fileInfo["extension"];
     $allowedExtensions = ["jpg", "jpeg", "gif", "png", "tif", "webp", "svg", "ico"];
     if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
         return;
     }

     //Checking if the folder exists or not
    $path = __DIR__ . "/images/";
    if(!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier \"images\" est manquant";

        return;
    }
       // We accept the file, store and rename it
$temp = explode(".", $_FILES["screenshot"]["name"]);
// function for a new name
$newfilename = round(microtime(true)) . "." . end($temp); 

// We move it with a new name to the right folder
move_uploaded_file($_FILES["screenshot"]["tmp_name"], $path . $newfilename);
$isFileLoaded = true;
?>
