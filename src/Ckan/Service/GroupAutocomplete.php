<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class GroupAutocomplete
 */
class GroupAutocomplete extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'group_autocomplete';

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
