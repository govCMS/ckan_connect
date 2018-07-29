<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class GroupListAuthz
 */
class GroupListAuthz extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'group_list_authz';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'available_only',
    'am_member',
  ];

}
