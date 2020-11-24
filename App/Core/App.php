<?php

namespace App\Core;

class App
{
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseURL();
    if (file_exists('../App/Controllers/' . $url[1] . '.php')) {
      $this->controller = $url[1];
      unset($url[1]);
    }

    require_once '../App/Controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[2])) {
      if (method_exists($this->controller, $url[2])) {
        $this->method = $url[2];
        unset($url[2]);
        unset($url[0]);
      }
    }

    $this->params = $url ? array_values($url) : [];

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseURL()
  {
    return explode('/', filter_var($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
  }

  public function currentURL()
  {
    $url = $this->parseURL();
    if ($url[1] == '' and !isset($url[2])) {
      $url[1] = 'home';
      $url[2] = 'index';
    } else if ($url[2] == '') {
      $url[2] = 'index';
    }
    return URL_BASE . $url[1] . "/" . $url[2] . "/";
  }
}
