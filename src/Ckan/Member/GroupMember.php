<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class GroupMember
 *
 * A member of a CKAN group, specifically a user.
 */
class GroupMember extends CkanMemberBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'group_member';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'id',
    'username',
    'role',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'id',
    'username',
    'role',
  ];

}
