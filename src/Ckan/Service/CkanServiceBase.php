<?php

namespace Drupal\ckan_connect\Ckan\Service;

use Drupal\ckan_connect\Ckan\CkanApiBase;

/**
 * Class CkanServiceBase
 *
 * CKAN has a large number of service endpoints.
 */
abstract class CkanServiceBase extends CkanApiBase {

  /**
   * {@inheritdoc}
   */
  public function getParameters() {
    $keys = array_keys($this->parameters);

    // Test for any required parameters.
    if (!empty(array_diff_key($this->requiredParameters, $keys))) {
      // @todo: throw error instead.
      return FALSE;
    }

    return $this->parameters;
  }

}
