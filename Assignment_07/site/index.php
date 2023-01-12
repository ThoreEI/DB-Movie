<?php
require_once "../src/php/Movie.php";
require_once "../src/php/DatabaseAbstractionLayer.php";
require_once "../src/vendor/autoload.php";
use php\DatabaseAbstractionLayer;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\StringLoaderExtension;
use Twig\Loader\FilesystemLoader;
session_start();
$pdo = new DatabaseAbstractionLayer();
//setcookie("safe_cookie", 333333, secure: true, httponly: true);
//foreach ($_COOKIE as $cookie)
//    echo $cookie . "\n";

if (isset($_POST["add_movie"]))
    $pdo->insert_record($_POST["title"], $_POST["director"], $_POST["year"], $_POST["playtime"], $_POST["fsk"]);

if (isset($_POST["delete_movie"]))
    $pdo->delete_movie($_POST["delete_movie"]);

if (isset($_POST["reset_session"])) {
    session_unset();
    DatabaseAbstractionLayer::delete_table();
    DatabaseAbstractionLayer::create_table();
    DatabaseAbstractionLayer::insert_default_movies();
}

    $movies = $pdo->load_movies($_GET["sort_by"] ?? "title", $_POST["order"] ?? "asc");
    $twig = new Environment(new FilesystemLoader('../src/'));
    $twig->addExtension(new StringLoaderExtension());
    try { echo $twig->render('index.html.twig', ['movies' => $movies]);
    } catch (LoaderError|RuntimeError|SyntaxError $e) {
        echo $e->getMessage();
}

