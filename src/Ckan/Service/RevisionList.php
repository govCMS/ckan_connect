<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class RevisionList
 */
class RevisionList extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'revision_list';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'since_id',
    'since_time',
    'sort',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'since_id',
    'since_time',
  ];

}
