<?php
require './vendor/autoload.php';
use App\Controler\AuthorController;
$controller=new AuthorController;
$dbconnect= new \App\Model\DBConnect();
$page=isset($_REQUEST['page'])?$_REQUEST['page']:null;
include_once 'app/View/backend/layouts/header.php';
try {
    switch ($page){
        case 'author-list':
            $controller->showAll();
            break;
        case 'create-author':
            $controller->create();
            break;
        case 'update-author':
            $controller->update();
            break;
        case 'delete-author':
            $controller->delete();
            break;

        default:
            $controller->showAll();
    }
}catch (Exception $exception){
    echo $exception->getMessage();
}
include_once 'app/View/backend/layouts/footer.php';