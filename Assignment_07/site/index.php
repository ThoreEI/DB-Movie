<?php
require_once "../src/php/Movie.php";
require_once "../src/php/DbMovie.php";
require_once "../src/vendor/autoload.php";
use php\DbMovie;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\StringLoaderExtension;
use Twig\Loader\FilesystemLoader;
$twig = new Environment(new FilesystemLoader('../src/'));
$twig->addExtension(new StringLoaderExtension());
$data_base = new DbMovie();
session_start();

if (isset($_POST["add_movie"]))
    $data_base->insert_record($_POST["title"], $_POST["director"], $_POST["year"], $_POST["playtime"], $_POST["fsk"]);

if (isset($_POST["delete_movie"]))
    $data_base->delete_movie($_POST["delete_movie"]);

if (isset($_POST["reset_session"]))
    session_unset();

$movies = $data_base->load_movies($_GET["sort_by"] ?? "title", $_POST["order"] ?? "asc");
try {
    echo $twig->render('index.html.twig', ['movies' => $movies]);
} catch (LoaderError|RuntimeError|SyntaxError $e) {
    echo $e->getMessage();
}