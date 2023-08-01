<?php

namespace Drupal\reports_extend;

use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Serialization\Yaml;
use Drupal\Core\Extension\ModuleHandler;
use Drupal\Core\Url;
/**
 * Service description.
 */
class ReportsExtendService
{

  protected $pathResolver;

  protected $moduleHandler;

  public function __construct(
    ExtensionPathResolver $path_resolver,
    ModuleHandler $module_handler
  ) {
    $this->pathResolver = $path_resolver;
    $this->moduleHandler = $module_handler;
  }

  /**
   * Method description.
   */
  public function reportsExportAllowedRoutes() {

    $routeList = [];
    $routesToExclude = ['visitors.settings', 'visitors.node', 'visitors_geoip.settings'];
    $modules = ['visitors', 'visitors_geoip'];
    foreach ($modules as $module) {
      if ($this->moduleHandler->moduleExists($module)) {
        $routingFilePath = DRUPAL_ROOT . '/' . $this->pathResolver->getPath('module', $module) . '/' . $module . '.routing.yml';
        $routingFileContents = file_get_contents($routingFilePath);
        $routes[] = array_keys(Yaml::decode($routingFileContents));
      }
    }
    if (count($routes)) {
      $routeList = array_unique(array_reduce($routes, function ($a, $p) {
        return array_merge($a, $p);
      }, array()));
    }
    return array_diff($routeList, $routesToExclude);
  }

  public function generateExportBtn(string $route = null) {
    $export_url = Url::fromRoute('reports_extend.export',['route' => $route])->toString();
    $build['#markup'] = '<a href="'.$export_url.'" class="button button--primary">'.t('Export').'</a>';
    return $build;
  }

  public function daysOfWeek() {
    return \Drupal::service('visitors.report')->daysOfWeek();
  }

  public function csvHeader($route) {
    switch($route) {
      case 'visitors.days_of_week':
        return [
          'id', 'أيام', 'الصفحات'
        ];
    }
  }
}
