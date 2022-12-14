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
$loader = new FilesystemLoader('../src/');
$twig = new Environment($loader);
$twig->addExtension(new StringLoaderExtension());
$data_base = new DbMovie();

session_start();
if (isset($_REQUEST["add_movie"]))
    $data_base->insert_record($_REQUEST["title"], $_REQUEST["director"], $_REQUEST["year"], $_REQUEST["playtime"], $_REQUEST["fsk"]);
if (isset($_REQUEST["delete_movie"])) {
    $movie_to_delete = $_REQUEST["delete_movie"];
    $data_base->delete_movie($movie_to_delete);
}
if (isset($_REQUEST["reset_session"]))
    session_unset();

$movies = $data_base->load_movies()->fetchAll();
$twig->addGlobal('movies', $movies);
try {
    echo $twig->render('index.html.twig', ['movies' => $movies]);
} catch (LoaderError|RuntimeError|SyntaxError $e) {
    http_response_code(500);
}