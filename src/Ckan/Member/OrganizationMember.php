<?php

namespace Drupal\ckan_connect\Ckan\Crud;

/**
 * Class OrganizationMember
 *
 * A member of a CKAN organization, specifically a user.
 */
class OrganizationMember extends CkanMemberBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'organization_member';

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
