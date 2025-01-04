<?php


namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use App\models\ArticlesModel;

class ArticleController{

public static function getData(){
    ArticlesModel::getData();
}
    
}