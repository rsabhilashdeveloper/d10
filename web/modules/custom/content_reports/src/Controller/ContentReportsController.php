<?php

namespace Drupal\content_reports\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Content Reports routes.
 */
class ContentReportsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $header = [
      'col1' => t('COL1'),
      'col2' => t('COL2'),
    ];
    $rows = [
      ['test col 1', 'test'],
      ['test col 1', 'test'],
      ['test col 1', 'test'],
    ];
    $build = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $build;
  }

}
