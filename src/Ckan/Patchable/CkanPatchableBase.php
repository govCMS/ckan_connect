<?php

namespace Drupal\ckan_connect\Ckan\Patchable;

use Drupal\ckan_connect\Ckan\Crud\CkanCrudBase;
use Drupal\ckan_connect\Client\CkanClient;

/**
 * Class CkanPatchableBase
 *
 * Any CKAN CRUD object that can also be patched - like update but only changes
 * the values you provide.
 */
abstract class CkanPatchableBase extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $validActions = [
    CkanClient::CKAN_ACTION_LIST,
    CkanClient::CKAN_ACTION_SHOW,
    CkanClient::CKAN_ACTION_CREATE,
    CkanClient::CKAN_ACTION_UPDATE,
    CkanClient::CKAN_ACTION_PATCH,
    CkanClient::CKAN_ACTION_DELETE,
  ];

}
