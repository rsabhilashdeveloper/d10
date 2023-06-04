<?php
namespace Drupal\d10_oops\Traits;

trait ColorTraits {

  public function printYellow() {
    echo "Hi, i am color yellow from::: ColorTraits \n";
  }
  // public function printBlue()
  // {
  //   echo "Hi, i am color blue from::: ColorTraits" . PHP_EOL;
  // }
  // private function printRed()
  // {
  //   echo "Hi, i am color red from::: ColorTraits" . PHP_EOL;
  // }

  // public  function printGreen()
  // {
  //   echo "Hi, i am color greens from::: ColorTraits" . PHP_EOL;
  // }

  public function getPrivateMethods($func_name) {
    return self::printGreen();
  }
}