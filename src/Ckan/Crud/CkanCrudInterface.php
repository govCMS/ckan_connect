<?php

namespace Drupal\ckan_connect\Ckan;

/**
 * Interface CkanCrudInterface
 */
interface CkanCrudInterface extends CkanApiInterface {

  /**
   * Get the set of valid actions for this CKAN object.
   *
   * @return array
   *   Array of valid actions as strings.
   */
  public function getValidActions();

}
