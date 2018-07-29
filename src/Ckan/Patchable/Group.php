<?php

namespace Drupal\ckan_connect\Ckan\Patchable;

/**
 * Class Group
 *
 * Groups are used in CKAN to gather objects (usually packages, users, or other
 * groups) into logical sets.
 */
class Group extends CkanPatchableBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'group';

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
