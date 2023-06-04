<?php
namespace Drupal\d10_oops\Classes;

use Drupal\d10_oops\Traits\ColorTraits;
use Drupal\d10_oops\Traits\ColorTraitsType2;

class Color {
  use ColorTraits, ColorTraitsType2 {
    ColorTraits::printYellow insteadOf ColorTraitsType2;
  }
  public function printViolet() {
    echo "Hi, i am color violet from::: Color Class \n";
  }
  // public function printGreen()
  // {
  //   echo "Hi, i am color green from::: Color Class \n";
  // }
  private function printRed()
  {
    echo "Hi, i am color red from::: Color Class" . PHP_EOL;
  }
}