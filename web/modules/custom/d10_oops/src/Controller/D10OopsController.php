<?php

namespace Drupal\d10_oops\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\d10_oops\Classes\Color;
use Drupal\d10_oops\Classes\GreenColor;

/**
 * Returns responses for D10 OOPS routes.
 */
class D10OopsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $color = new Color();
    $greencolor = new GreenColor();
    // $color->printViolet();
    // $color->printYellow();
    $color->printYellow();
    echo "<br>";
    // $greencolor->printGreen();
    // $color->getPrivateMethods('printGreen');
    // dump($color);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
