<?php

require_once __DIR__ . '/app/controllers/ArticlesController.php';
require_once __DIR__ . '/app/controllers/UsersController.php';

use App\Controllers\ArticleController;
use App\Controllers\UsersController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    if ($_GET['action'] === 'addArticle') {
        ArticleController::addArticle();
    }

    if ($_GET['action'] === 'addUser') {
        UsersController::addUser();
        
        header('Location: /index.php');
        exit();

    }
}
