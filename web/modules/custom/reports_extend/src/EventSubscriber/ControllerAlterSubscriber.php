<?php
namespace Drupal\reports_extend\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\reports_extend\ReportsExtendService;

/**
 * Class ControllerAlterSubscriber.
 */
class ControllerAlterSubscriber implements EventSubscriberInterface {

  protected $routeProvider;
  /**
   * ControllerAlterSubscriber constructor.
   *
   * @param \Drupal\Core\Routing\RouteProviderInterface $routeProvider
   */

  protected $reportsExtendService;
  public function __construct(
    RouteProviderInterface $routeProvider,
    ReportsExtendService $reportsExtendService,
    )
  {
    $this->routeProvider = $routeProvider;
    $this->reportsExtendService = $reportsExtendService;
  }
  /**
   * Alters the controller output.
   */
  public function onView(ViewEvent $event) {
    $request = $event->getRequest();
    $route = $request->attributes->get('_route');
    if(in_array($route, $this->reportsExtendService->reportsExportAllowedRoutes())) {
      $build = $event->getControllerResult();
      if (is_array($build)) {
        // alter controller build array
        array_unshift($build, $this->reportsExtendService->generateExportBtn($route));
        $event->setControllerResult($build);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::VIEW][] = ['onView', 50];
    return $events;
  }

}