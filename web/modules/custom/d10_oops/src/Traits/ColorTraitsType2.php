<?php
namespace Drupal\d10_oops\Traits;

trait ColorTraitsType2 {

  public function printYellow() {
    echo "Hi, i am color yellow from::: ColorTraitsType2 \n";
  }
  public function printBlue()
  {
    echo "Hi, i am color blue from::: ColorTraitsType2" . PHP_EOL;
  }
  private function printRed()
  {
    echo "Hi, i am color red from::: ColorTraitsType2" . PHP_EOL;
  }

  public  function printGreen()
  {
    echo "Hi, i am color greens from::: ColorTraitsType2" . PHP_EOL;
  }
}