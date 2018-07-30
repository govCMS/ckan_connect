<?php

namespace Drupal\ckan_connect\Ckan\Service;

use Drupal\ckan_connect\Ckan\CkanApiBase;

/**
 * Class CkanServiceBase
 *
 * CKAN has a large number of service endpoints.
 */
class CkanRequest extends CkanApiBase {

  /**
   * CkanRequest constructor.
   *
   * @param $action
   * @param array $parameters
   */
  public function __construct($action, $parameters = []) {
    $this->machineName = $action;
    $this->parameters = $parameters;
  }

  /**
   * {@inheritdoc}
   */
  public function validateParameters($parameters) {
    // We don't do any error checking for generic service calls.
    return TRUE;
  }

}
