<?php


namespace App\Model;
use PDO;
use PDOException;

class DBConnect
{
    private $dsn;
    private $username;
    private $password;

    /**
     * DBConnect constructor.
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct( )
    {
        $this->dsn ="mysql:host=localhost;dbname=demodb;charset=utf8";
        $this->username = "root";
        $this->password = "Nguyenngoc@123";
    }

    public function connect(){
        try {
            $con= new PDO($this->dsn,$this->username,$this->password);
//            echo "hello";
            return $con;
        }catch (PDOException $exception){
            $exception->getMessage();
        }
    }


}