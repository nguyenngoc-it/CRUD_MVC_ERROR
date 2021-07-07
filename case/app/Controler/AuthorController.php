<?php


namespace App\Controler;


use App\Model\AuthorModel;

class AuthorController
{
    protected $authorModel;
    public function __construct(){
        $this->authorModel= new AuthorModel();

    }
    public function showAll(){
        $authors=$this->authorModel->getAll();
        include_once "app/View/backend/author/list.php";
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            include_once 'app/View/backend/author/create.php';
        }else{
            $this->authorModel->create($_REQUEST);
            header('location:index.php');
        }
    }
    public function update(){

        if ($_SERVER['REQUEST_METHOD']==="GET"){
            $id= $_REQUEST['id'];
            $author= $this->authorModel->getById($id);
            include'app/View/backend/author/update.php';
        }else{
            $this->authorModel->update($_REQUEST);
            header('location:index.php');
        }
    }

    public function delete(){
        $id= $_REQUEST['id'];
        $this->authorModel->delete($id) ;
        header('location: index.php');
    }

}