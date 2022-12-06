<?php
require 'index.php';
$valid_values_to_sort_by = ["title", "producer", "year", "playtime", "fsk"];

$value_to_sort_by = $_GET["value_to_sort_by"];
if (in_array($value_to_sort_by, $valid_values_to_sort_by))
    sortEntries($value_to_sort_by);
else
    http_response_code(400);

function sortEntries($sort): void
{
    $filme = $_SESSION['filme'];
    if ($sort == "title") {
        usort($filme, function ($a, $b) {
            return strcmp($a->title, $b->title);
        });
    } elseif ($sort == "producer") {
        usort($filme, function ($a, $b) {
            return strcmp($a->producer, $b->producer);
        });
    } elseif ($sort == "year") {
        usort($filme, function ($a, $b) {
            return $a->year <=> $b->year;
        });
    } elseif ($sort == "playtime") {
        usort($filme, function ($a, $b) {
            return $a->playtime <=> $b->playtime;
        });
    } elseif ($sort == "fsk") {
        usort($filme, function ($a, $b) {
            return strcmp($a->fsk, $b->fsk);
        });
    }
    $_SESSION['filme'] = $filme;
    header("Location: index.php");
}