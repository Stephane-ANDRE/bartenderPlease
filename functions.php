<?php
// Function to check if a recipe is valid (enabled).
function isValidRecipe(array $recipe): bool
{
    // Check if the 'is_enabled' key exists in the recipe array.
    if (array_key_exists("is_enabled", $recipe)) {
        // If 'is_enabled' key exists, set $isEnabled to its value.
        $isEnabled = $recipe["is_enabled"];
    } else {
        // If 'is_enabled' key doesn't exist, set $isEnabled to false.
        $isEnabled = false;
    }
    
    return $isEnabled;
};

// Function to filter out valid (enabled) recipes.
function getRecipes(array $recipes): array
{
    // Create an empty array to store valid recipes.
    $valid_recipes = [];

    // Iterate through each recipe in the recipes array.
    foreach ($recipes as $recipe) {
        // Check if the current recipe is valid (enabled).
        if (isValidRecipe($recipe)) {
            // If the recipe is valid, add it to the valid_recipes array.
            $valid_recipes[] = $recipe;
        }
    }

    // Return the array of valid recipes.
    return $valid_recipes;
}

// Function to display the author's name and age based on their email.
function displayAuthor(string $authorEmail, array $users): string
{
    // Iterate through each user in the users array.
    foreach ($users as $user) {
        // Check if the author's email matches the email of the current user.
        if ($authorEmail === $user['email']) {
            // If there's a match, return the author's full name and age.
            return $user['full_name'] . '(' . $user['age'] . '  ans)';
        }
    }
    // If the author's email is not found in the users array, return an empty string.
    return '';
}
// Function to handle the redirection
function redirectToUrl(string $url)
{
    // Redirect the user to the specified URL
    header("Location: {$url}");
    // Terminate the script execution immediately after redirection
    exit();
}
?>