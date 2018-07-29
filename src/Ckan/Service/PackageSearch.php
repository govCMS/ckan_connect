<?php

namespace Drupal\ckan_connect\Ckan\Service;

/**
 * Class PackageSearch
 */
class PackageSearch extends CkanServiceBase {

  /**
   * {@inheritdoc}
   */
  protected $machineName = 'package_search';

  /**
   * {@inheritdoc}
   */
  protected $validParameters = [
    'q',
    'fq',
    'sort',
    'rows',
    'start',
    'facet',
    'facet.mincount',
    'facet.limit',
    'facet.field',
    'include_drafts',
    'include_private',
    'use_default_schema',
    'qf',
    'wt',
    'bf',
    'boost',
    'tie',
    'defType',
    'mm',
  ];

}
