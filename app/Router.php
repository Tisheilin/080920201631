<?php

namespace App;

class Router
{
  private $method;
  private $url;
  private $route;
  private $routes;
  private $isAjax;
  private $defaultControllerPath = __DIR__.'/../controllers/';

  function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    if($this->method == 'POST' && empty($_POST)) {
      $_POST = json_decode(file_get_contents('php://input'), true);
    }
    $this->isAjax = $this->getMethod();
    include_once __DIR__.'/../configs/routers.php';
    $this->routes = $definedRoutes;
  }

  private function parseUrl()
  {
    $getPosition = strpos($this->url, '?');
    if($getPosition) {
      $this->route = substr($this->url, 0,$getPosition);
    } else {
      $this->route = $this->url;
    }
  }

  private function getRoute() {
    if(isset($this->routes[$this->route])) {
      $this->runAction($this->routes[$this->route]);
    } else {
      $this->render404();
    }
  }

  private function getMethod() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      return true;
    } else {
      return false;
    }
  }

  public function run() {
    $this->parseUrl();
    $this->getRoute();
  }

  public function render404() {
    header("HTTP/1.1 404 Not Found");
    if(!$this->isAjax) {
      include_once __DIR__.'/../views/404.php';
    } else {
      echo '404 Page not found';
    }
    exit;
  }

  private function runAction($route) {
    $controllerPath = $this->defaultControllerPath.$route['controller'].'.php';
    if(!file_exists($controllerPath)) {
      $this->render404();
    }
    if($route['method'] !== $this->method) {
      $this->render404();
    }
    $class = "\\Controllers\\".$route['controller'];
    if(!class_exists($class)) {
      $this->render404();
    }
    $action = 'action'.ucfirst($route['action']);
    $controller = new $class();
    if(!method_exists($controller, $action)) {
      $this->render404();
    }

    call_user_func([$controller, $action]);
  }

}