<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class PackageAutocomplete
 */
class PackageAutocomplete extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'package_autocomplete';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'q',
    'limit',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'q',
  ];

}
