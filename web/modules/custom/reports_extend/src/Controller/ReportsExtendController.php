<?php

namespace Drupal\reports_extend\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\reports_extend\Event\ExportReportsEvent;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Drupal\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Reports Extend routes.
 */
class ReportsExtendController extends ControllerBase
{

  /**
   * The event dispatcher.
   *
   * @var \Drupal\Component\EventDispatcher\ContainerAwareEventDispatcher
   */
  protected $eventDispatcher;

  /**
   *
   * @param \Drupal\Component\EventDispatcher\ContainerAwareEventDispatcher $event_dispatcher
   */
  public function __construct(ContainerAwareEventDispatcher $event_dispatcher)
  {
    $this->eventDispatcher = $event_dispatcher;
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('event_dispatcher')
    );
  }

  /**
   * Builds the response.
   */
  public function exportData($route)
  {
    ob_flush();
    $event = new ExportReportsEvent($route);
    $this->eventDispatcher->dispatch($event, ExportReportsEvent::EXPORT);
    $fullData[] = $event->getHeader();
    $fullData = array_merge($fullData, $event->getExportData());

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    foreach (['A', 'B', 'C'] as $col) {
      $columnWidth = $sheet->getColumnDimension($col);
      $columnWidth->setWidth(30);
    }

    $sheet->fromArray($fullData, NULL, 'A1');
    // Set bold font style for the first row
    $firstRow = $sheet->getRowIterator(1, 1)->current();
    $firstRowCells = $firstRow->getCellIterator();
    foreach ($firstRowCells as $cell) {
      $cell->getStyle()->getFont()->setBold(true);
    }
    //  Create a writer object and save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $fileSystem = \Drupal::service('file_system');

    $file_path = 'public://export.xlsx';
    $filePath = $fileSystem->realpath($file_path);
    $writer->save($filePath);

    // Provide the file for download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="export.xlsx"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    ob_end_flush();
    exit;
  }
}
