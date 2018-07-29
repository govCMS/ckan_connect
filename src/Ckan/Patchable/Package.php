<?php

namespace Drupal\ckan_connect\Ckan\Patchable;

/**
 * Class Package
 *
 * A package is the primary object for a CKAN dataset.
 */
class Package extends CkanPatchableBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'package';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'name',
    'id',
    'title',
    'description',
    'image_url',
    'type',
    'state',
    'approval_status',
    'extras',
    'packages',
    'groups',
    'users',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'name',
  ];

}
