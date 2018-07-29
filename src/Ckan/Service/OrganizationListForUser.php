<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class OrganizationListForUser
 */
class OrganizationListForUser extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'organization_list_for_user';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'id',
    'permission',
    'include_dataset_count',
  ];

}
