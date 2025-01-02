<?php

namespace App\Models;

use App\Config\Database;


class Tags{


    private static $table = "tags";
    private static $column = "name_tag";


    public static function showTags(){

        $tags = Database::getData(self::$table);
        return $tags;
    }

    public static function addTags($values){

        $tags=Database::Add(self::$table,self::$column,$values);

        if($tags){

            header("Location:tag.php");
        }

    }

    public function deletTag($id){


    } 

    public function getTagById(){


    }

    public function update(){

    }

    public static function countTags(){

        $countTags=Database::countItems(self::$table);
        return $countTags;

    }








}