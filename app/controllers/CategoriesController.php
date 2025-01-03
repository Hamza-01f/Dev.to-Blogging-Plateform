<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\ModelCategories;

class CategoriesController{



    // public function index(){
    //     $tags = Tags::all();
    // }


    public static function create(){
        
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

    public function destroy($id){
        
    }

    




}