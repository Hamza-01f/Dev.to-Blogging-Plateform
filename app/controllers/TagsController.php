<?php
namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';
 
use App\Models\Tags;

class TagsController{

    // public function index(){
    //     $tags = Tags::all();
    // }


    // public static function create(){

    //     if (isset($_POST['addTag']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //            $tag = $_POST['name_tag'];
    //            $result=Tags::addTags($tag);
    //            echo'tag will be sent ';
    //     }

    //    return $result;
        
    // }

    // public function store(){
        
    // }

    public static function show(){
        $tags = Tags::showTags();
        return $tags;
    }

    public static function delete($id) {
        $result = Tags::deleteTag($id);
        if ($result) {
            header("Location: tag.php");
            exit; 
        } else {
            echo 'Failed to delete tag.';
        }
    }

    public static function edit($id) {
        return Tags::findTagById($id); // Retrieve the tag data by ID
    }

    public static function update($id, $newTag) {
        $result = Tags::updateTag($id, $newTag);
            // Redirect to the tags list page after successful update
            header("Location: tag.php");
            exit; // Make sure to exit after header redirect
    }


}


