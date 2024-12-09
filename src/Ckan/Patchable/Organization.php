<?php

namespace Drupal\ckan_connect\Ckan\Patchable;

/**
 * Class Organization
 *
 * CKAN Organisations are normally the owners of datasets.
 */
class Organization extends CkanPatchableBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'organization';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'name',
    'id',
    'title',
    'description',
    'image_url',
    'state',
    'approval_status',
    'extras',
    'packages',
    'users',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'name',
  ];

}
