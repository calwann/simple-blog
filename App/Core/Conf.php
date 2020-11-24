<?php

namespace App\Core;

class Conf
{
  public static function headerPrevious()
  {
    $fallback = 'index.php';

    $previous = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $fallback;

    return header("location: " . $previous);
  }
}
