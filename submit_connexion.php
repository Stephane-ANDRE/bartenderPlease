<?php 

    //Allows us to get a session and store datas like email, name, etc...
    session_start();

    require_once(__DIR__ . '/config/mysql.php');
    require_once(__DIR__ . '/database_connect.php');
    require_once(__DIR__ . "/variables.php");
    require_once(__DIR__ . "/functions.php");
    
    // Capture POST data from the form submission
    $postData = $_POST;

        // Validate email format 
        if (isset($postData["email"]) &&  isset($postData["password"]) && isset($postData["name"]) ) {
        if (!filter_var($postData["email"], FILTER_VALIDATE_EMAIL)) {
            // If email is not valid, set error message
            $_SESSION["LOGIN_ERROR_MESSAGE"] = "Vous avez besoin d'un email valide pour vous connecter";
        } else {
            // Validate password format
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+}{":;\'?\/>.<,= -]).{13,}$/', $postData["password"])) {
                // If password is not valid, set error message
                $_SESSION["LOGIN_ERROR_MESSAGE"] = "Le mot de passe doit contenir au moins 13 caractères avec au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
            } else {
                // Loop through the users array to find a match
                foreach($users as $user) {
                    // Check if email match any user
                    if(
                        $user["email"] === $postData["email"] &&
                        $user['password'] === $postData['password']
                    ) {
                        // If match found, log the user in the user array
                        $_SESSION["LOGGED_USER"] = [
                            "email" => $user["email"],
                            "name" => isset($user["full_name"]) ? $user["full_name"] : "",
                            "user_id" => $user["user_id"],
                        ];
                    }
                }
            if (!isset($_SESSION["LOGGED_USER"])) {
                $_SESSION["LOGIN_ERROR_MESSAGE"] = sprintf(
                    'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                    $postData['email'],
                    strip_tags($postData['password'])
                );
            }
        }
    }
    redirectToUrl("index.php");
}
?>