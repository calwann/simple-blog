<?php

namespace App;

use App\Core\App;

class Pagination extends App
{
  public $data; // DB data
  public $current; //
  public $amout;
  public $record;
  public $count;
  public $result;

  public function __construct(
    $data,
    $current,
    $amout
  ) {
    $this->data = $data;
    $this->current = $current;
    $this->amout = $amout;
  }

  public function result()
  {
    $this->record = array_chunk($this->data, $this->amout);
    $this->count = count($this->record);

    if ($this->count > 0) {
      $this->result = $this->record[$this->current - 1];
      return $this->result;
    } else {
      return [];
    }
  }

  public function navigator()
  {
    echo "<ul class='pagination'>";
    for ($i = 1; $i <= $this->count; $i++) {
      if ($i == $this->current) {
        echo "<li class='active'><a href='#'>" . $i . "</a></li>";
      } else {
        echo "<li><a href='" . $this->currentURL() . "?page=" . $i . "'>" . $i . "</a></li>";
      }
    }
    echo "</ul>";
  }
}
