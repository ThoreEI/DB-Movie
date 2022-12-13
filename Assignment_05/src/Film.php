<?php

class Film {
    public $title;
    public $director;
    public $year;
    public $playtime;
    public $fsk;

    public function __construct($title, $director, $year, $playtime, $fsk) {
        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
        $this->playtime = $playtime;
        $this->fsk = $fsk;
    }
}