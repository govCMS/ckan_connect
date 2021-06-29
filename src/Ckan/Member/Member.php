<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class Member
 *
 * A member of a CKAN group, could be a user, package, or even another group.
 */
class Member extends CkanMemberBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'member';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'id',
    'object',
    'object_type',
    'capacity',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'id',
    'object',
    'object_type',
    'capacity',
  ];

}
