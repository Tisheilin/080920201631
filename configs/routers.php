<?php
$definedRoutes = [
  '/'       =>["method" => 'GET',  "controller" => 'AddressController', "action" => "index"],
  '/create' =>["method" => 'POST', "controller" => 'AddressController', "action" => "create"],
  '/remove' =>["method" => 'POST', "controller" => 'AddressController', "action" => "remove"]
];