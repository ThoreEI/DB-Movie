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
$twig = new Environment(new FilesystemLoader('../src/'));
$twig->addExtension(new StringLoaderExtension());
session_start();
$pdo = new DatabaseAbstractionLayer();

if (isset($_POST["add_movie"]))
    $pdo->insert_record($_POST["title"], $_POST["director"], $_POST["year"], $_POST["playtime"], $_POST["fsk"]);

if (isset($_POST["delete_movie"]))
    $pdo->delete_movie($_POST["delete_movie"]);

if (isset($_POST["reset_session"]))
    session_unset();

$movies = $pdo->load_movies($_GET["sort_by"] ?? "title", $_POST["order"] ?? "asc");
try { echo $twig->render('index.html.twig', ['movies' => $movies]);
} catch (LoaderError|RuntimeError|SyntaxError $e) {
    echo $e->getMessage();
}