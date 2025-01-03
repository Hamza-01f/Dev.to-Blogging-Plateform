<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\ModelCategories;

class CategoriesController{



    // public function index(){
    //     $tags = Tags::all();
    // }


    public static function create($value){
        $category = ModelCategories::create($value);
    }


    public static function show(){
        $category = ModelCategories::display();
        return $category;
    }

    public function edit($id){
        $tag = Tags::find($id);
    }

    public function update($id){
        
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