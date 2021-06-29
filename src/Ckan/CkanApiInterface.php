<?php

namespace Drupal\ckan_connect\Ckan;

/**
 * Interface CkanApiInterface
 */
interface CkanApiInterface {

  /**
   * Set the parameters to be used in create, update or patch queries.
   *
   * @param $parameters
   *   An associative array of parameters: [param_key => param_value].
   *
   * @return bool
   */
  public function setParameters($parameters);

  /**
   * Get the last part of the API endpoint specific to this CKAN object.
   *
   * @param string $action
   *
   * @return string
   *   The action slug, e.g. package_delete or organisation_create
   */
  public function getPath();

  /**
   * Get the parameters to be used by the API call.
   *
   * @return array
   *   An associative array of parameters: [param_key => param_value].
   */
  public function getParameters();

}
