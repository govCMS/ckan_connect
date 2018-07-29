<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class PackageRevisionList
 */
class PackageRevisionList extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'package_revision_list';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'id',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'id',
  ];

}
