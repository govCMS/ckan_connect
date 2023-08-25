# CKAN Connect

CKAN connect is a [Drupal 8/9/10](https://www.drupal.org/project/ckan_connect) companion module for the
[Data Visualisation Framework (DVF)](https://github.com/govCMS/dvf) module. Its goal is to provide
[CKAN](https://ckan.org/) connectivity and abstract API calls. Other modules can use CKAN connect
if they need CKAN connectivity from Drupal and it does not require DVF to function.

CKAN is the industry standard for large dataset storage and is used by most governments for public
data storage. It provides a robust API for retrieving data records with support for filtering,
searching and more.

Examples of CKAN instances:
* [data.gov.au](https://data.gov.au/)
* [data.nsw.gov.au](https://data.nsw.gov.au/)
* [data.gov](https://data.gov/)
* [data.gov.uk](https://data.gov.uk/)

## Install and configure

### Install
CKAN connect is ideally installed via composer
```
composer require drupal/ckan_connect
```
Then enabled via Drupal UI or drush
```
drush en ckan_connect
```

### Configure

Once installed you must set the Base URL for the CKAN instance.

* Visit: Admin > Configuration > Webservices > CKAN Connect (`/admin/config/services/ckan-connect`)
* Set the API url to match your CKAN instance eg. `https://data.gov.au/api/3`
* If you need write access to CKAN or you need to view private datasets then you can also
  add an API key. Note the security implications here, you could potentially expose private
  data on your Drupal site when an API key is used.

## CKAN Connect API

### Add as dependency

If your module requires CKAN Connect, ensure dependencies are added

#### composer.json
```json
"require": {
    "drupal/ckan_connect": "*"
}
```

#### module.info.yml
```yml
dependencies:
  - ckan_connect:ckan_connect
```

### Usage

The [CkanClientInterface](https://github.com/govCMS/ckan_connect/blob/8.x-1.x/src/Client/CkanClientInterface.php)
documents available methods, but most of the time you will only need the `get()` method. This
will make an API call to a specific endpoint with the appropriate query parameters added.

Example of querying the `action/datastore_search` endpoint:

```php
use Drupal\ckan_connect\Client\CkanClientInterface;

$client = new CkanClientInterface();

$response = $client->get('action/datastore_search', [
  'id' => 'da675507-10b5-4825-8e79-09dcbb577ece',
  'limit' => 10,
  'offset' => 0,
]);

if ($response->success === TRUE) {
  var_dump($response->result);
}
```

View the [CKAN API docs](https://docs.ckan.org/en/2.9/api/) for more information on available endpoints
and query parameters.

## Issues and feature suggestions

Development of CKAN Connect is currently occurring over at [GitHub](https://github.com/govCMS/ckan_connect)

Issues are ideally logged in the [Github issue queue](https://github.com/govCMS/ckan_connect/issues)
but we also monitor the [Drupal issue queue](https://www.drupal.org/project/ckan_connect/dvf)

## Contributing and extending CKAN Connect

We welcome (and appreciate) improvements and fixes to CKAN Connect, so if you
have something to add please submit a
[Github pull request](https://github.com/govCMS/ckan_connect/pulls).

## Supporting organizations

### Primary Developers

[Doghouse Agency](http://doghouse.agency)

### Sponsors

* [govCMS](https://www.govcms.gov.au/)
* [Department of the Environment and Energy](http://www.environment.gov.au/)
