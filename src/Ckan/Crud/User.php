<?php

namespace Drupal\ckan_connect\Ckan\Crud;

use Drupal\ckan_connect\Client\CkanClient;

/**
 * Class User
 *
 * Users in CKAN are very much like users in Drupal, they can be added to
 * Organisations and Groups, and given various permissions.
 */
class User extends CkanCrudBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'user';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'name',
    'email',
    'password',
    'id',
    'fullname',
    'about',
  ];

  /**
   * {@inheritdoc}
   */
  protected $requiredParameters = [
    'name',
    'email',
    'password',
  ];

  /**
   * {@inheritdoc}
   */
  protected function validateParameters($action) {
    $valid = parent::validateParameters($action);

    // From the docs: "Can not modify existing user's name."
    if ($valid && $action === CkanClient::CKAN_ACTION_UPDATE && array_key_exists('name', $this->parameters)) {
      $valid = FALSE;
    }

    return $valid;
  }

}
