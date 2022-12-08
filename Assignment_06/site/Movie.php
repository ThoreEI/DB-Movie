<?php
class Movie {
    public string $title;
    public string $producer;
    public int $year;
    public int $playtime;
    public int $fsk;

    public function __construct($title, $producer, $year, $playtime, $fsk) {
        $this->title = $title;
        $this->producer = $producer;
        $this->year = $year;
        $this->playtime = $playtime;
        $this->fsk = $fsk;
    }

    function equals(Movie $other) : bool {
        return gettype($this) == gettype($other)
            && $this->title == $other->title
            && $this->year == $other->year
            && $this->playtime == $other->playtime
            && $this->fsk == $other->fsk;
    }
}