<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class ResourceSearch
 */
class ResourceSearch extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'resource_search';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'query',
    'fields',
    'order_by',
    'offset',
    'limit',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'query',
  ];

}
