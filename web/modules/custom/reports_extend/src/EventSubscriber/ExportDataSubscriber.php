<?php
namespace Drupal\reports_extend\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\reports_extend\ReportsExtendService;
use Drupal\reports_extend\Event\ExportReportsEvent;
/**
 * Class ExportDataSubscriber.
 */
class ExportDataSubscriber implements EventSubscriberInterface {


  protected $reportsExtendService;

  public function __construct(ReportsExtendService $reportsExtendService)
  {
    $this->reportsExtendService = $reportsExtendService;
  }

  public function exportData(ExportReportsEvent $event) {
    if($event->getRouteName()) {
      $data = [];
      $header = [];
      switch($event->getRouteName()) {
        case 'visitors.days_of_week':
          $data = $this->reportsExtendService->daysOfWeek();
          $header = $this->reportsExtendService->csvHeader($event->getRouteName());
        break;
      }
      $event->setExportData($data);
      $event->setHeader($header);
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[ExportReportsEvent::EXPORT][] = ['exportData', 100];
    return $events;
  }

}