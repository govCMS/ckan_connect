<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class PackageRelationship
 *
 * A relationship between two CKAN packages.
 */
class PackageRelationship extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'package_relationship';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'subject',
    'object',
    'type',
    'comment',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'subject',
    'object',
    'type',
  ];

  /**
   * {@inheritdoc}
   */
  public function getPath() {
    if ($this->action === 'list') {
      // This object doesn't follow the apparent naming convention in the CKAN
      // API.
      return $this->machineName . 's_' . $this->action;
    }
    return parent::getPath();
  }

}
