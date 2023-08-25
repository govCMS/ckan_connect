<?php

namespace Drupal\Tests\ckan_connect\Unit\Form;

use Drupal\Tests\UnitTestCase;
use Drupal\ckan_connect\Client\CkanClient;
use Drupal\Core\Config\ConfigFactoryInterface;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Tests the CkanClient class.
 *
 * @group ckan_connect
 */
class CkanConnectClientTest extends UnitTestCase {

  /**
   * The CkanClient instance to be tested.
   *
   * @var \Drupal\ckan_connect\Client\CkanClient
   */
  protected $ckanClient;

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    $httpClient = new GuzzleHttpClient();
    // Create a mock for the Drupal config factory.
    $configFactory = $this->createMock(ConfigFactoryInterface::class);
    // Create a mock configuration object.
    $configMock = $this->createMock(\Drupal\Core\Config\Config::class);
    // Setup expectations for the config object.
    $configMock->expects($this->any())
      ->method('get')
      ->willReturnMap([
        ['api.url', 'https://data.gov.au/data/api/3'],
        ['api.key', ''],
      ]);
    // Set up expectations for getConfig() and get() methods.
    $configFactory->expects($this->any())
      ->method('get')
      ->with('ckan_connect.settings')
      ->willReturn($configMock);

    // Create an instance of the CkanClient class for testing.
    $this->ckanClient = new CkanClient($httpClient, $configFactory);
  }

  /**
   * Test that ckan client GET response is correct.
   */
  public function testCkanClientGetResponse() {
    $query = [
      'resource_id' => '0e32d958-3796-4dca-8312-489ef7a610f6',
      'limit' => 5,
    ];

    $response = $this->ckanClient->get('action/datastore_search', $query );

    $this->assertIsObject($response);
    $this->assertObjectHasAttribute('result', $response);
    $this->assertObjectHasAttribute('records', $response->result);
    $this->assertCount(5, $response->result->records);
  }

}
