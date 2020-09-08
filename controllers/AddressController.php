<?php
namespace Controllers;

use \App\ControllerBase;
use \Models\Address;

class addressController extends ControllerBase
{
  public function actionIndex(){
    $address = new Address();
    $addressList = $address->getAll();
    $this->render('view', ['addressList'=>$addressList]);
  }

  public function actionCreate(){
    $address = new Address();
    if ( isset($_POST['name']) && isset($_POST['city']) && isset($_POST['area']) ){
      $address->name = $_POST['name'];
      $address->city = $_POST['city'];
      $address->area = $_POST['area'];
      $address->street = $_POST['street'];
      $address->house = $_POST['house'];
      $address->information = $_POST['information'];
      $result = $address->create();
    } else {
      $result = false;
    }

    header('Location: /');
  }

  public function actionRemove(){
    $address = new Address();
    if ( isset($_POST['id']) ) {
      $result = $address->remove($_POST['id']);
      $this->outputResult($result, $address->getAll());
    } else {
      $this->outputResult(false, ["error" => 'Id not found']);
    }
  }
}