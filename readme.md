Drupal CKAN Connect
===================

This is a developer module that provides a client for the [CKAN action API](http://docs.ckan.org/en/latest/api/index.html#action-api-reference).

Usage
-----

Every API request has three steps:
1. Create a new object related to the CKAN entity or service you wish to interact with.
2. Set any required properties on the object. 
3. Use the `ckan_connect.client` service to make the API call using your newly created object.

### Service calls

> Technically, service calls can be used for any request to the CKAN API. They do not do any parameter checking and they 
all work exactly the same way. If you want parameter validation and automatic handling of IDs where required for entity
actions, use the [CRUD-like objects](#crud-like-objects). 

A service call is easy to use as long as you know exactly what the API is expecting. Just give it the full action name
such as `package_search` or `organization_autocomplete` and any parameters it requires. Parameters can be given in the
construction method, or separately via `CkanApiInterface::setParameters($parameters)`.

```php
<?php

use Drupal\ckan_connect\Ckan\Service\CkanRequest;

//...

$package_search = new CkanRequest('package_search');
$parameters = [
  'q' => 'search terms',
];
$package_search->setParameters($parameters);
$client = \Drupal::service('ckan_connect.client');
$search_result = $client->action($package_search); 

// OR

$package_search = new CkanRequest('package_search', ['q' => 'search terms']);
$client = \Drupal::service('ckan_connect.client');
$search_result = $client->action($package_search); 

```

That's it. The client uses the API URL and API key you've stored in settings and handles any errors that are thrown by
guzzle or the API itself so that your application doesn't crash.

### CRUD-like objects

Where the CKAN endpoints can be grouped together into a set of related functions, they are bunched into one of these
object types:

- CRUD objects have endpoint actions for Create, Read (`show`), Update and Delete, they are in `\src\Ckan\Crud\*`. They 
  also allow a `list` action.
- Patchable objects have an additional `patch` action on top of the ones allowed by CRUD objects and are in 
  `\src\Ckan\Patchable\*`. The `patch` action is like `update` except that it only updates the values provided in the
  call, rather than overwriting all values the way `update` does.
- Member objects are basically entity references and can only created or deleted (a subset of CRUD). These are in 
  `\src\Ckan\Member\*`.
  
When creating a new CRUD-like object, note that the creation call expects an ID as a string. You can leave this string
empty if the object is going to be used for a `create` or `list` action but it expects a full CKAN ID for any other
action.

```php
<?php

use Drupal\ckan_connect\Ckan\Patchable\Organization;

//...

// Create and list calls only:
$new_organization = new Organization('');

// Show, update, patch and delete calls:
$existing_organization = new Organization('a107c3bd-dece-4d45-a352-f0e33188de9b');

```

Once you have created your object, if the action requires parameters, add them:

```php
<?php

// Organizations only require a name property on creation
$parameters = [
  'name' => 'my_organization',
];

$new_organization->setParameters($parameters);

// If we're doing an update or patch call, we only need to provide the new fields
// Update will assume the required 'name' field stays the same, and will remove the
// value of any other field we don't provide.
// Patch will just update the title.
$parameters = [
  'title' => 'New Title For This Organisation'
];

$existing_organization->setParameters($parameters);

```

When you add parameters they will be checked to make sure they are valid for this object, an error will be thrown if 
validation fails.

Because CRUD-like objects can be used for multiple actions and this affects whether the ID is sent to the endpoint or
not, you need to set the action on the object:

```php
<?php

use Drupal\ckan_connect\Client\CkanClient;

//...

$new_organization->setAction(CkanClient::CKAN_ACTION_CREATE);

$existing_organization->setAction(CkanClient::CKAN_ACTION_PATCH);
```

Now you're ready to make the API call:

```php
<?php

// You should use dependency injection if you can, this is just the side-load method
$client = \Drupal::service('ckan_connect.client');

$create_result = $client->action($new_organization);

$patch_result = $client->action($existing_organization);
```

In summary the code to create a brand new Organization in your CKAN repository could look like this:

```php
<?php

use Drupal\ckan_connect\Ckan\Patchable\Organization;
use Drupal\ckan_connect\Client\CkanClient;

//...

$new_organization = new Organization('');
$new_organization->setParameters(['name' => 'my_organisation']);
$new_organization->setAction(CkanClient::CKAN_ACTION_CREATE);
$client = \Drupal::service('ckan_connect.client');
$create_result = $client->action($new_organization);
```
