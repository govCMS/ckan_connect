<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class CurrentPackageListWithResources
 */
class CurrentPackageListWithResources extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'current_package_list_with_resources';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'limit',
    'offset',
    'page',
  ];

}
