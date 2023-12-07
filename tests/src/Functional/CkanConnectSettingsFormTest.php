<?php

namespace Drupal\Tests\ckan_connect\Unit\Form;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the CkanConnectSettingsForm class.
 *
 * @group ckan_connect
 */
class CkanConnectSettingsFormTest extends BrowserTestBase {

  /**
   * Modules to enable during test setup.
   *
   * @var array
   */
  protected static $modules = [
    'ckan_connect',
    'user',
  ];

  /**
   * User with proper permissions for module configuration.
   *
   * @var \Drupal\user\Entity\User|false
   */
  protected $adminUser;

  /**
   * Theme for tests relying on no markup at all or at least no core markup.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * The ckan url.
   *
   * @var string
   */
  protected $ckanUrl = 'https://data.gov.au/data/api/3';

  /**
   * The ckan connect admin config url.
   *
   * @var string
   */
  protected $adminConfigUrl = '/admin/config/services/ckan-connect';

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();
    $this->adminUser = $this->drupalCreateUser([
      'administer site configuration',
      'administer ckan connect',
    ]);

    $this->drupalLogin($this->adminUser);
    $this->drupalGet($this->adminConfigUrl);
    $this->assertSession()->statusCodeEquals(200);
  }

  /**
   * Test that the correct form fields in the admin config exists.
   */
  public function testCkanConfigForm() {
    // Checked that the config fields exist.
    $this->assertSession()->pageTextContains("Optionally specify an API key.");
    $this->assertSession()->pageTextContains("Specify the endpoint URL. Example https://data.gov.au/api/3 (please note no trailing slash).");
    $this->assertSession()->fieldExists("api[url]");
    $this->assertSession()->fieldExists("api[key]");
  }

  /**
   * Test that the config values are saved.
   */
  public function testCkanConfigValuesAreSaved() {
    $edit = [
      'api[url]' => $this->ckanUrl,
      'api[key]' => '',
    ];

    $this->submitForm($edit, 'Save configuration');
    $config_factory = $this->container->get('config.factory');
    $value = $config_factory->get('ckan_connect.settings')->get('api.url');
    $this->assertSame($this->ckanUrl, $value);
  }

  /**
   * Test that an error message is displayed when api cant establish a connection.
   */
  public function testConnectionErrorMessage() {
    $errorMessage = 'Could not establish a connection to the endpoint. Error: 404';

    $this->checkConfigPageError([
      'api[url]' => 'https://data.gov.au/data/api/api/3',
      'api[key]' => '',
    ], $errorMessage);
  }

  /**
   * Test that an error message is displayed when the API URL does not use HTTPS.
   */
  public function testApiUrlWithHttpDisplaysErrorMessage() {
    $errorMessage = 'If using an API key, the API URL must use HTTPS.';

    $this->checkConfigPageError([
      'api[url]' => 'http://data.gov.au/data/api/3',
      'api[key]' => '862hg74n5464',
    ], $errorMessage);
  }

  /**
   * Test that API key authorization validation works as expected.
   */
  public function testApiKeyAuthorizationValidationWorks() {
    $errorMessage = 'API return "Not Authorised" please check your API key.';

    $this->checkConfigPageError([
      'api[url]' => $this->ckanUrl,
      'api[key]' => '5d5545s4fg=878',
    ], $errorMessage);
  }

  /**
   * Check that error message exist on the page.
   */
  public function checkConfigPageError($config = [], $errorMessage = '') {
    $this->submitForm($config, 'Save configuration');
    $this->assertSession()->pageTextContains($errorMessage);
  }

}
