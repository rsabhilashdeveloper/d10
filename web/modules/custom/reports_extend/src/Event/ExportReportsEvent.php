<?php

namespace Drupal\reports_extend\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ExportReportsEvent extends Event
{

  const EXPORT = 'reports_extend.export';

  protected $routeName;

  protected $data = [];

  protected $header = [];

  public function __construct($routeName)
  {
    $this->routeName = $routeName;
  }

  public function getRouteName()
  {
    return $this->routeName;
  }

  public function setExportData($data)
  {
    $this->data = $data;
  }

  public function getExportData()
  {
    return $this->data;
  }

  public function setHeader($header)
  {
    $this->header = $header;
  }

  public function getHeader()
  {
    return $this->header;
  }
}
