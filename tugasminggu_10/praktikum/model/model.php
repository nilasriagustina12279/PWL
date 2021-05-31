<?php
require 'model/books.php';


//
class Model
{
    //
    public function getBookList()
    {
        //ceritanya ini dari database.
        //jika akan menggunakan database,
        //berarti kita query dulu dari database
        return array(
            "Jungle Book" => new Books("Jungle Book", "R. Kipling", "Adventure story of a child in wilderness"),

            "Moonwalker" => new Books("Moonwalker", "J. Walker", "A group of man wander around the moon"),

            "PHP for Dummies" => new Books("PHP for Dummies", "Team Dummies", "Non-intimading guide for those starting with PHPs")
        );
    }

    //
    public function getBook($title)
    {
        //kalau menggunakan database
        //kita harus select... from nama-tabel

        //memanggil fungsi getBookList()
        //dan disimpan dalam variabel $allbooks
        $allbooks = $this->getBookList();

        //mengembalikan hanya key
        //bernama 'title'
        return $allbooks['title'];
    }
}