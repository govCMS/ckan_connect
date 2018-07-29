<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class OrganizationRevisionList
 */
class OrganizationRevisionList extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'organization_revision_list';

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
