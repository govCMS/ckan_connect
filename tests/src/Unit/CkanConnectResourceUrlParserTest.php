<?php

namespace Drupal\Tests\ckan_connect\Unit\Form;

use Drupal\ckan_connect\Parser\CkanResourceUrlParser;
use Drupal\Tests\UnitTestCase;

/**
 * Tests the CkanConnectSettingsForm class.
 *
 * @group ckan_connect
 */
class CkanConnectResourceUrlParserTest extends UnitTestCase {
  /**
   * The Ckan resource parser service.
   *
   * @var \Drupal\ckan_connect\Parser\CkanResourceUrlParser
   */
  protected $ckanResourceUrlParser;

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    $ckanClient = $this->createMock('\Drupal\ckan_connect\Client\CkanClientInterface');
    $logger = $this->createMock('\Psr\Log\LoggerInterface');
    $this->ckanResourceUrlParser = new ckanResourceUrlParser($ckanClient, $logger);
  }

  /**
   * Test that the ckan parser does not recognize invalid urls.
   */
  public function testParserDoesNotRecognizeInvalidUrls() {
    $urls = [
      'https://data.gov.au/dataset/ds-dga-d667403f-2016-463f-bb0a-3087ae67c57f/resource-not/0e32d958-3796-4dca-8312-489ef7a610f6',
      'https://data.gov.au/data/api/3/action/datastore_search?resource=0e32d958-3796-4dca-8312-489ef7a610f6&limit=5',
      'data.gov.au/dataset/ds-dga-d667403f-2016-463f-bb0a-3087ae67c57f',
    ];

    foreach ($urls as $url) {
      $options = $this->ckanResourceUrlParser->parse($url);
      $this->assertFalse($options);
    }
  }

  /**
   * Test that the ckan parser recognizes a correct ckan url.
   */
  public function testParserRecognizesValidCkanUrl() {
    $url = 'https://data.gov.au/dataset/ds-dga-d667403f-2016-463f-bb0a-3087ae67c57f/resource/0e32d958-3796-4dca-8312-489ef7a610f6';
    $options = $this->ckanResourceUrlParser->parse($url);
    $this->assertIsArray($options);
    $this->assertArrayHasKey('resource_id', $options);
    $this->assertSame($options['resource_id'], '0e32d958-3796-4dca-8312-489ef7a610f6');
  }

}
