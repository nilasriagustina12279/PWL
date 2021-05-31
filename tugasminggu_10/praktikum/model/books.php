<?php
class Books
{
    public $title;
    public $authors;
    public $description;

    //konstruktor
    public function __construct($title, $authors, $description)
    {
        $this->title = $title;

        $this->authors = $authors;

        $this->description = $description;
    }
}