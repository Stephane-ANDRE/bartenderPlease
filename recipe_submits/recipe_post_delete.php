<?php

session_start();

// Include necessary files
require_once(__DIR__ . '/../isConnect.php');
require_once(__DIR__ . '/../config/mysql.php');
require_once(__DIR__ . '/../database_connect.php');
require_once(__DIR__ . '/../functions.php');

$postData = $_POST;

//checking if you are allowed to delete a recipe
if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}

// SQL request
$deleteRecipeStatement = $mysqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :id');
$deleteRecipeStatement->execute([
    'id' => (int)$postData['id'],
]);

//after deleting, redirect to homepage
redirectToUrl('index.php');