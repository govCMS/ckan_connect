<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class RevisionShow
 */
class RevisionShow extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'revision_show';

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
