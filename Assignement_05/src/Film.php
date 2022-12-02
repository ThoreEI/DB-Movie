<?php

class Film
{

    // Properties
    public $title;
    public $producer;
    public $year;
    public $playtime;
    public $fsk;

    // Constructor
    public function __construct($title, $producer, $year, $playtime, $fsk)
    {
        $this->title = $title;
        $this->producer = $producer;
        $this->year = $year;
        $this->playtime = $playtime;
        $this->fsk = $fsk;
    }


}