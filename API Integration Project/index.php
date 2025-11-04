<?php
/**
 * Entry point of the app, ties everything together
 */
require_once "config.php";
require_once "CatApi.php";
require_once "CatApp.php";

// creates CatApi object and CatApp object so they can be used on this page
$api = new CatApi(CAT_API_KEY, CAT_BASE_URL);
$app = new CatApp($api);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Assignment 1 API">
    <title>Assignment 1 | Working with API's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="CSS/styles.css" rel="stylesheet">
</head>
<body>
<header>
    <ul class="nav nav-bar nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Reload</a>
        </li>
    </ul>
</header>
<main>
<?php
$app->showRandomCats(); // calls showRandomCats method, what's actually displaying the content
?>
</main>
<footer>
    <p> © 10 Random Cat Pics 2025. All images are property of The Cat Api.</p>
</footer>
</body>
</html>

