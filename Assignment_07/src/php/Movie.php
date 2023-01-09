<?php
namespace php;
class Movie {
    public string $title, $director;
    public int $year, $playtime, $fsk;

    public function __construct($title, $director, $year, $playtime, $fsk) {
        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
        $this->playtime = $playtime;
        $this->fsk = $fsk;
    }
}