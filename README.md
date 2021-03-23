# Twitchfa-api
Twitchfa-api client written with PHP for [Twitchfa](https://Twitchfa.com) based on
[Coingecko-Api](https://github.com/codenix-sv/coingecko-api) structure

For additional information about API visit [Twitchfa v2 documentation](https://api.twitchfa.com/v2/docs)

## Requirements
* PHP >= 7.52
* ext-json
* guzzlehttp/guzzle

## Basic usage 
### Example

```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->searchStreamers('mechiller');
```

You can get last response (`ResponseInterface::class`) uses `getLastResponse` method:

```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->searchStreamers('fk_orca');
$response = $client->getLastResponse();
$headers = $response->getHeaders();
```

## Available methods
### Twitch

[getBanners](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getBanners)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getBanners();
```

[getNotifications](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getNotifications)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getNotifications();
```

[searchStreamers](https://api.twitchfa.com/v2/docs/#/default/TwitchController_searchStreamers)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->searchStreamers('fk_orca');
```

[getFollowing](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getFollowing)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getFollowing();
```

[getSelf](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getSelf)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getSelf();
```

[getStreamers](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getStreamers)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getStreamers(1,10);
```

[addStreamer](https://api.twitchfa.com/v2/docs/#/default/TwitchController_addStreamer)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->addStreamer('some_random_username');
```

[getTwitchStats](https://api.twitchfa.com/v2/docs/#/default/TwitchController_getTwitchStats)
```php
use Twitchfa\TwitchfaClient;

$client = new TwitchfaClient();
$result = $client->twitch()->getTwitchStats();
```
