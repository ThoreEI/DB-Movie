<?php
class Movie {
    public string $title;
    public string $director;
    public int $year;
    public int $playtime;
    public int $fsk;

    public function __construct($title, $director, $year, $playtime, $fsk) {
        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
        $this->playtime = $playtime;
        $this->fsk = $fsk;
    }

    function equals(Movie $other) : bool {
        return gettype($this) == gettype($other)
            && $this->title == $other->title
            && $this->director == $other->director
            && $this->year == $other->year
            && $this->playtime == $other->playtime
            && $this->fsk == $other->fsk;
    }
}