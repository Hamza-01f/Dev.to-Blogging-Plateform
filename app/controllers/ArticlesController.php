<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use App\models\ArticlesModel;
use App\Models\ArticleTagsModel;

class ArticleController{

public static function getData(){
    $articles = ArticlesModel::getData($_SESSION['user']['id']);
    return $articles;
}

public static function incrementView($articleId){
     ArticlesModel::incrementView($articleId);
     $artilcedata = ArticlesModel::getDataOfArticle($articleId);
     return $artilcedata;
}


public static function getAdmineArticle(){

    $articles = ArticlesModel::getAdmineArticle();
    return $articles;
}

public static function getPublicData(){
    $articles = ArticlesModel::getPublicData();
    return $articles;
}

public static function publish($id){
    ArticlesModel::publish($id);
}

public static function draft($id){
    ArticlesModel::draft($id);
}

public static function addArticle( $id ){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addArticle'])) {

        $title = htmlspecialchars(trim($_POST['title']));
        $slug = htmlspecialchars(trim($_POST['slug']));
        $content = htmlspecialchars(trim($_POST['content']));
        $featured_image = htmlspecialchars(trim($_POST['featured_image']));
        $category = htmlspecialchars(trim($_POST['category']));
        $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,       
            'featured_image' => $featured_image,
            'status' => 'draft',
            'category' => $category,
            'author' =>  $id ,
            'tags' => $tags
        ];
    
    }

    $articleId = ArticlesModel::addArticle($data);
    if (isset($data['tags']) && count($data['tags']) > 0) {
        ArticleTagsModel::addTagsToArticle($articleId, $data['tags']);
    }

}

public static function updateArticle($id){
       if(isset($_POST['updateArticle']) && $_SERVER['REQUEST_METHOD'] === "POST"){

        $title = htmlspecialchars(trim($_POST['title']));
        $slug = htmlspecialchars(trim($_POST['slug']));
        $content = htmlspecialchars(trim($_POST['content']));
        $featured_image = htmlspecialchars(trim($_POST['featured_image']));
        $category = htmlspecialchars(trim($_POST['category']));
        $tags = isset($_POST['tags']) ? $_POST['tags'] : [];


        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'featured_image' => $featured_image,
            'category' => $category,
            'tags' => $tags
        ];
       }

       ArticlesModel::update($id, $data);

       if (isset($data['tags']) && count($data['tags']) > 0) {
        
            ArticleTagsModel::deleteTagsForArticle($id);

            ArticleTagsModel::addTagsToArticle($id, $data['tags']);
        }
}

public static function delete($id){
    $article = ArticlesModel::delete($id);
    if($article){
        header('Location:/app/view/AdmineDashboard/articles/ManageArticles.php');
        exit();
    }
}

public static function getSpecificData($id){
    $article = ArticlesModel::getSpecificData($id);
    return $article;
}

}