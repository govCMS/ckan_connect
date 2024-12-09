<?php

namespace Drupal\ckan_connect\Ckan;

use Drupal\ckan_connect\Client\CkanClient;

/**
 * Class CkanApiBase
 */
abstract class CkanApiBase implements CkanApiInterface {

  /**
   * @var string $machineName
   *   The machine name for this CKAN object e.g. 'resource' or 'package'.
   */
  protected $machineName = NULL;

  /**
   * @var array $parameters
   *   Parameters for use in create, patch and update queries as an associative
   *   array [param_key => param_value].
   */
  protected $parameters = [];

  /**
   * @var array $validParameters
   *   An array of valid parameter keys e.g. ['name', 'title', 'private', ...]
   */
  protected $validParameters = [];

  /**
   * @var array $requiredParameters
   *   An array of required parameter keys.
   */
  protected $requiredParameters = [];

  /**
   * {@inheritdoc}
   */
  public function setParameters($parameters) {
    if ($this->validateParameters($parameters)) {
      $this->parameters = $parameters;
      return TRUE;
    }
    // @todo: throw error instead.
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getPath() {
    return $this->machineName;
  }

  /**
   * {@inheritdoc}
   */
  public function getParameters() {
    return $this->parameters;
  }

  /**
   * Ensure the parameters are valid and complete.
   *
   * @param string $action
   *   The action being requested: create|update|patch.
   */
  protected function validateParameters($parameters) {
    $keys = array_keys($parameters);

    // Check for invalid parameter keys.
    if (!empty(array_diff_key($keys, $this->validParameters))) {
      return FALSE;
    }

    return TRUE;
  }

}
