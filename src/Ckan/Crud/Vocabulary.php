<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class Vocabulary
 *
 * A CKAN tag vocabulary (similar to a Drupal taxonomy vocabulary).
 */
class Vocabulary extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'vocabulary';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'name',
    'tags',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'name',
    'tags',
  ];

}
