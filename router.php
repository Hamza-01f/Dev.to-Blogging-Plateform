<?php
require_once __DIR__ . '/app/controllers/ArticlesController.php';

require_once __DIR__ . '/app/models/ArticlesModel.php';

use App\Controllers\ArticleController;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {

    if ($_GET['action'] === 'addArticle') {

        ArticleController::addArticle();
    }

    
}
