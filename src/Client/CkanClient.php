<?php

namespace Drupal\ckan_connect\Client;

use Drupal\ckan_connect\Ckan\CkanApiInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use GuzzleHttp\Client;

/**
 * Provides a CKAN client.
 */
class CkanClient implements CkanClientInterface {

  const CKAN_ACTION_LIST   = 'list';
  const CKAN_ACTION_SHOW   = 'show';
  const CKAN_ACTION_CREATE = 'create';
  const CKAN_ACTION_UPDATE = 'update';
  const CKAN_ACTION_PATCH  = 'patch';
  const CKAN_ACTION_DELETE = 'delete';

  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The API URL.
   *
   * @var string
   */
  protected $apiUrl;

  /**
   * The API key.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * Constructs a new CkanClient.
   *
   * @param \GuzzleHttp\Client $http_client
   *   The HTTP client.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(Client $http_client, ConfigFactoryInterface $config_factory) {
    $this->httpClient = $http_client;
    $this->configFactory = $config_factory;

    $config = $this->configFactory->get('ckan_connect.settings');

    $this->apiUrl = $config->get('api.url');
    $this->apiKey = $config->get('api.key');
  }

  /**
   * {@inheritdoc}
   */
  public function getApiUrl() {
    return $this->apiUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function setApiUrl($api_url) {
    $this->apiUrl = $api_url;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getApiKey() {
    return $this->apiKey;
  }

  /**
   * {@inheritdoc}
   */
  public function setApiKey($api_key) {
    $this->apiKey = $api_key;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function get($path, array $parameters = []) {
    $uri = $this->getApiUrl() . '/' . $path;
    $options = ['query' => $parameters];

    if ($this->getApiKey()) {
      $options['headers']['Authorization'] = $this->getApiKey();
    }

    $response = $this->httpClient->get($uri, $options)
      ->getBody()
      ->getContents();
    $response = json_decode($response);

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function post($path, array $parameters) {
    $uri = $this->getApiUrl() . '/' . $path;
    $options = ['form_params' => $parameters];

    if ($this->getApiKey()) {
      $options['headers']['Authorization'] = $this->getApiKey();
    }

    $response = $this->httpClient->post($uri, $options)
      ->getBody()
      ->getContents();
    $response = json_decode($response);

    return $response;
  }

  /**
   * Send an action query to the API.
   *
   * @param string $action
   * @param \Drupal\ckan_connect\Ckan\CkanApiInterface $ckanObject
   *
   * @return mixed|\stdClass|string
   */
  public function action(CkanApiInterface $ckanObject) {
    $path = 'action/' . $ckanObject->getPath();
    $parameters = $ckanObject->getParameters();

    // Every action API endpoint on CKAN may be used with a POST request.
    return $this->post($path, $parameters);
  }

}
