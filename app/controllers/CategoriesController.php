<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\ModelCategories;

class CategoriesController{


    public static function create($value){
        $category = ModelCategories::create($value);
    }


    public static function show(){
        $category = ModelCategories::display();
        return $category;
    }

    public static function edit($id){
        $category = ModelCategories::findTagById($id);
        return $category;
    }

    public static function update($id , $newValue){
        $category = ModelCategories::updateCategory($id , $newValue);
    }

    public static function delete($id){
        $category = ModelCategories::delete($id);
        if ($category) {
            header("Location: category.php");
            exit; 
        } else {
            echo 'Failed to delete tag.';
        }
    }

    




}