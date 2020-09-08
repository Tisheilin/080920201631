<?php

namespace Models;

use App\DbConnection;

class Address
{
  public $id;
  public $name;
  public $city;
  public $area;
  public $street;
  public $house;
  public $information;

  function __construct(){

  }

  function create(){
    $sql = 'INSERT INTO address (name, city, area, street, house, information) VALUES (:name, :city, :area, :street, :house, :information)';
    $params = [
      ':name' => $this->name,
      ':city' => $this->city,
      ':area' => $this->area,
      ':street' => $this->street,
      ':house' => $this->house,
      ':information' => $this->information,
    ];
    $conn = new DbConnection();
    $result = $conn->query($sql, $params);
    return $result;
  }

  function remove($id){
    $sql = 'DELETE FROM address WHERE id = :id';
    $params = [
      ':id' => $id,
    ];
    $conn = new DbConnection();
    $result = $conn->query($sql, $params);
    return $result;
  }

  function getAll(){
    $sql = 'SELECT * FROM address ORDER BY name';
    $params = [];
    $conn = new DbConnection();
    $result = $conn->fetchAll($sql, $params);
    return $result;
  }
}