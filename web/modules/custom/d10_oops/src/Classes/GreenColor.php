<?php
namespace Drupal\d10_oops\Classes;

use Drupal\d10_oops\Traits\ColorTraits;

class GreenColor extends Color{
  use ColorTraits;
  public function printGreen()
  {
    echo "Hi, i am color green from::: Green color Class \n";
  }
}