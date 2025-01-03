<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
 

class CategoriesController{



    public function index(){
        $tags = Tags::all();
    }


    public function create(){
        
    }

    public function store(){
        
    }

    public function show($id){
        $tag = Tags::find($id);
    }

    public function edit($id){
        $tag = Tags::find($id);
    }

    public function update($id){
        
    }

    public function destroy($id){
        
    }

    




}