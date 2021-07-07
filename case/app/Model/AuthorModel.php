<?php


namespace App\Model;


class AuthorModel
{
    private $dbConnect;

    public function __construct()
    {
        $this->dbConnect=new DBConnect();
    }
    public function getAll(){
        try {
            $sql= "select * from `authors`";
            $stmt=$this->dbConnect->connect()->query($sql);
            $stmt->execute();
            return $this->convertAllToObj($stmt->fetchAll());
        }
        catch (\PDOException $exception){
            die( $exception->getMessage());

        }
    }

    public function convertToObject($data){
        $author= new Author($data['first_name'],$data['last_name'],$data['email'],$data['birthdate']);
        $author->setId($data['id']);
        return $author;
    }

    public function convertAllToObj($data){
        $objs=[];
        foreach ($data as $item){
            $objs[]=$this->convertToObject($item);
        }
        return $objs;
    }

    public function create($request){
        try {
            $sql= "insert into `authors`(`first_name`,`last_name`,`email`,`birthdate`) values (?,?,?,?)";
            $stmt=$this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1,$request['first-name']);
            $stmt->bindParam(2,$request['last-name']);
            $stmt->bindParam(3,$request['email']);
            $stmt->bindParam(4,$request['birthdate']);
            $stmt->execute();
        }catch (\PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function update($request){
        try {
            $sql="update `authors` set `first_name`=?, `last_name`=?,`email`=?,`birthdate`=? where `id`=".$request['id'];
            $stmt= $this->dbConnect->connect()->prepare($sql);
            $stmt->bindParam(1,$request['first-name']);
            $stmt->bindParam(2,$request['last-name']);
            $stmt->bindParam(3,$request['email']);
            $stmt->bindParam(4,$request['birthdate']);
            $stmt->execute();


        }catch (\Exception $exception){
            $exception->getMessage();
        }}

    public function getById($id){
        try {
            $sql= "select * from `authors` where `id`=$id";
            $stmt=$this->dbConnect->connect()->query($sql);
            $stmt->execute();
            return $this->convertToObject($stmt->fetchAll());

        }catch (\PDOException $exception){
            die($exception->getMessage());
        }
    }

    public function delete($id  ){
        $sql="delete from `authors` where `id`=$id";
        $stmt= $this->dbConnect->connect()->prepare($sql);
        $stmt->execute();
    }

}