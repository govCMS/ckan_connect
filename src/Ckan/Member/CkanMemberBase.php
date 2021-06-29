<?php

namespace Drupal\ckan_connect\Ckan\Member;

use Drupal\ckan_connect\Ckan\Crud\CkanCrudBase;
use Drupal\ckan_connect\Client\CkanClient;

/**
 * Class MemberBase
 *
 * CKAN member objects can only be created or deleted.
 */
abstract class CkanMemberBase extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $validActions = [
    CkanClient::CKAN_ACTION_CREATE,
    CkanClient::CKAN_ACTION_DELETE,
  ];

}
