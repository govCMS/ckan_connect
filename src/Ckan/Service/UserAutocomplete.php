<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class UserAutocomplete
 */
class UserAutocomplete extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'user_autocomplete';

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
