<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class Tag
 *
 * A CKAN tag (similar to a Drupal taxonomy item).
 */
class Tag extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'tag';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'name',
    'vocabulary_id',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'name',
    'vocabulary_id',
  ];

}
