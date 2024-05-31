<!-- if user is not logged, display the form -->
<?php if (!isset($_SESSION["LOGGED_USER"])) : ?>
<form action="submit_connexion.php" method="POST">
    <!-- Display the error message if it exists and the form has been submitted -->
    <?php if (isset($_SESSION["LOGIN_ERROR_MESSAGE"])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION["LOGIN_ERROR_MESSAGE"];
            unset($_SESSION["LOGIN_ERROR_MESSAGE"]); ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="name" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($postData["name"]) ? $postData["name"] : "" ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@example.com" value="<?php echo isset($postData["email"]) ? $postData["email"] : "" ?>">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
        <div id="password-help" class="form-text">
        Le mot de passe doit contenir au moins 13 caractères avec au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<!-- if user is logged we send a message -->
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $_SESSION["LOGGED_USER"]["name"]; ?>, bienvenue sur le site et profite de ces recettes!
    </div>
    
<?php endif; ?>
