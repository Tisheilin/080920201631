<?php
namespace App;

use PDO;

class DbConnection
{
  private static $conn = null;

  function __construct(){
    if( !self::$conn ){
      self::$conn = $this->connect();
    }
  }

  private function connect(){
    $conn = new PDO("mysql:host=".dbhost.";dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
    return $conn;
  }

  public function query($sql, $params){
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($params);
    return $result;
  }

  public function fetch($sql, $params){
    $stmt = self::$conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function fetchAll($sql, $params){
    $stmt = self::$conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
  }
}
