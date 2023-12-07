<?php

namespace Drupal\ckan_connect\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StreamWrapper\StreamWrapperManager;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\ckan_connect\Client\CkanClientInterface;

/**
 * Configures CKAN Connect settings for this site.
 */
class CkanConnectSettingsForm extends ConfigFormBase {

  /**
   * The ckan client.
   *
   * @var \Drupal\ckan_connect\Client\CkanClientInterface
   */
  protected $ckanClient;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, CkanClientInterface $ckanClient) {
    parent::__construct($config_factory);
    $this->ckanClient = $ckanClient;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('ckan_connect.client')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ckan_connect_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ckan_connect.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve the CKAN Connect configuration object.
    $config = $this->config('ckan_connect.settings');

    // Define form elements for API settings within a fieldset.
    $form['api'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('API settings'),
      '#tree' => TRUE,
    ];

    // Define a textfield for API URL with default value from configuration.
    $form['api']['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API URL'),
      '#description' => $this->t('Specify the endpoint URL. Example https://data.gov.au/api/3 (please note no trailing slash).'),
      '#default_value' => $config->get('api.url'),
      '#required' => TRUE,
    ];

    // Define a textfield for API Key.
    $form['api']['key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#description' => $this->t('Optionally specify an API key.'),
      '#default_value' => $config->get('api.key'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $this->validateApiUrl($form, $form_state);
    $this->validateApiKey($form, $form_state);
  }

  /**
   * Validates the API URL field.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function validateApiUrl(array &$form, FormStateInterface $form_state) {
    // Retrieve API URL and API key from the form state.
    $api_url = $form_state->getValue(['api', 'url']);
    $api_key = $form_state->getValue(['api', 'key']);

    // Check if an API key is provided.
    if (!empty($api_key)) {
      // Ensure the API URL uses HTTPS when an API key is present.
      if (StreamWrapperManager::getScheme($api_url) !== 'https') {
        // Log an error message and set a form error if HTTPS is not used.
        $message = $this->t('If using an API key, the API URL must use HTTPS.');
        $this->logger('ckan_connect')->error($message);
        $form_state->setErrorByName('api_url', $message);
      }
    }
  }

  /**
   * Validates the API Key field.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function validateApiKey(array &$form, FormStateInterface $form_state) {
    $api_url = $form_state->getValue(['api', 'url']);
    $api_key = $form_state->getValue(['api', 'key']);

    try {
      // Set the CKAN client's API URL based on the provided form state value.
      $this->ckanClient->setApiUrl($api_url);

      // Make a CKAN API request based on whether an API key is provided.
      if ($api_key) {
        $this->ckanClient
          ->setApiKey($api_key)
          ->get('action/dashboard_activity_list', ['limit' => 1]);
      }
      else {
        $this->ckanClient->get('action/site_read');
      }
    }
    catch (RequestException $e) {
      // Handle exceptions, retrieve response status code and set appropriate form errors.
      $response = $e->getResponse();
      $status_code = $response->getStatusCode();
      $message = '';

      switch ($status_code) {
        case 403:
          $message = $this->t('API return "Not Authorised" please check your API key.');
          $form_state->setErrorByName('api_url', $message);
          break;

        default:
          $message = $this->t('Could not establish a connection to the endpoint. Error: @code', ['@code' => $status_code]);
          $form_state->setErrorByName('api_url', $message);
      }

      // Log the error message along with additional details.
      $this->logger('ckan_connect')->error("$message @message", [
        '@message' => $e->getMessage(),
      ]);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the CKAN Connect configuration object.
    $config = $this->config('ckan_connect.settings');
    // Set and save the API URL and API key values from the form state into the configuration.
    $config
      ->set('api.url', $form_state->getValue(['api', 'url']))
      ->set('api.key', $form_state->getValue(['api', 'key']));
    $config->save();

    // Invoke the parent class's submitForm method for additional processing.
    parent::submitForm($form, $form_state);
  }

}
