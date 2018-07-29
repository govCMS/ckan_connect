<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class ResourceView
 *
 * A resource view in CKAN is a web page that display the resource in various
 * ways such as in a data explorer or as an image.
 */
class ResourceView extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'resource_view';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'resource_id',
    'title',
    'description',
    'view_type',
    'config',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'resource_id',
    'title',
    'view_type',
  ];

}
