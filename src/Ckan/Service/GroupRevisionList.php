<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class GroupRevisionList
 */
class GroupRevisionList extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'group_revision_list';

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
