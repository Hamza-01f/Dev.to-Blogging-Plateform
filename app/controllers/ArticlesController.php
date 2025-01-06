<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use App\models\ArticlesModel;
use App\Models\ArticleTagsModel;

class ArticleController{

public static function getData(){
    $articles = ArticlesModel::getData();
    return $articles;
}

public static function addArticle(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addArticle'])) {
       
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'content' => $_POST['content'],
            'excerpt' => $_POST['excerpt'],
            'meta_description' => $_POST['meta_description'],
            'featured_image' => $_POST['featured_image'],
            'status' => 'draft',
            'category' => $_POST['category'],
            'author' => $_POST['author'],
            'tags' => isset($_POST['tags']) ? $_POST['tags'] : []
        ];
    
    }

    $articleId = ArticlesModel::addArticle($data);
    if (isset($data['tags']) && count($data['tags']) > 0) {
        ArticleTagsModel::addTagsToArticle($articleId, $data['tags']);
    }

}

public static function updateArticle($id){
       if(isset($_POST['updateArticle']) && $_SERVER['REQUEST_METHOD'] === "POST"){
        $data = [
            'title' => $_POST['title'],
            'slug' => $_POST['slug'],
            'content' => $_POST['content'],
            'excerpt' => $_POST['excerpt'],
            'meta_description' => $_POST['meta_description'],
            'featured_image' => $_POST['featured_image'],
            'status' => $_POST['status'],
            'category' => $_POST['category'],
            'author' => $_POST['author'],
            'tags' => isset($_POST['tags']) ? $_POST['tags'] : []
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