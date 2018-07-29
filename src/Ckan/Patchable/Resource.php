<?php

namespace Drupal\ckan_connect\Ckan\Patchable;

/**
 * Class Resource
 *
 * A resource contains information about a single data file or endpoint.
 * Resources are gathered together in packages.
 */
class Resource extends CkanPatchableBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'resource';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'package_id',
    'url',
    'revision_id',
    'description',
    'format',
    'hash',
    'name',
    'resource_type',
    'mimetype',
    'mimetype_inner',
    'cache_url',
    'size',
    'created',
    'last_modified',
    'cache_last_updated',
    'upload',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'package_id',
    'url',
  ];

}
