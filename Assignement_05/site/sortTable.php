<?php
require '../src/Movie.php';
session_start();
$valid_values_to_sort_by = ["title", "producer", "year", "playtime", "fsk"];

$value_to_sort_by = $_GET["value_to_sort_by"];
if (in_array($value_to_sort_by, $valid_values_to_sort_by))
    sortEntries($value_to_sort_by);
else
    http_response_code(400);

function sortEntries($sort) : void {
$entries = $_SESSION['entries'];
if ($sort == "title") {
usort($entries, function ($a, $b) {
return strcmp($a->title, $b->title);
});
} elseif ($sort == "producer") {
usort($entries, function ($a, $b) {
return strcmp($a->producer, $b->producer);
});
} elseif ($sort == "year") {
usort($entries, function ($a, $b) {
return $a->year <=> $b->year;
});
} elseif ($sort == "playtime") {
usort($entries, function ($a, $b) {
return $a->playtime <=> $b->playtime;
});
} elseif ($sort == "fsk") {
usort($entries, function ($a, $b) {
return strcmp($a->fsk, $b->fsk);
});
}
$_SESSION['entries'] = $entries;
header("Location: index.php");
}