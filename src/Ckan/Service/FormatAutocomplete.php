<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class FormatAutocomplete
 */
class FormatAutocomplete extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'format_autocomplete';

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
