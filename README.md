sleeper-api-php-lib
===================

[![Build Status](https://www.travis-ci.org/SchoppAx/sleeper-api-php-lib.svg?branch=master)](https://www.travis-ci.org/SchoppAx/sleeper-api-php-lib)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SchoppAx/sleeper-api-php-lib/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SchoppAx/sleeper-api-php-lib/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/SchoppAx/sleeper-api-php-lib/badge.svg?branch=master)](https://coveralls.io/github/SchoppAx/sleeper-api-php-lib?branch=master)

[![PHP from Packagist](https://poser.pugx.org/schoppax/sleeper-api-php-lib/require/php)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![Latest Stable Version](https://poser.pugx.org/schoppax/sleeper-api-php-lib/v/stable)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![Total Downloads](https://poser.pugx.org/schoppax/sleeper-api-php-lib/downloads)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![License](https://poser.pugx.org/schoppax/sleeper-api-php-lib/license.png)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)

Sleeper API PHP library for consuming fantasy content from [official read-only Sleeper HTTP API](https://docs.sleeper.app/)

# Installation

If you're using Composer to manage dependencies, you can run the following command:

```sh
$ composer require schoppax/sleeper-api-php-lib
```

or add the following to your composer.json file:
```json
"require": {
  "schoppax/sleeper-api-php-lib": "1.*",
}
```

# Usage

``` php
use SchoppAx\Sleeper\SleeperClient;

$client = new SleeperClient();
```

## Examples

### League
Get a specific league by id:
``` php
try {
  $league = $client->leagues()->find('289646328504385536');
  echo $league['league_id'];
  echo $league['name'];
  echo $league['season'];
  echo $league['roster_positions'];
} catch(BadMethodCallException $be) {

} catch(Exception $e) {

}
```

### User
Get the user object by either providing the username or user_id:
``` php
try {
  $user = $client->users()->find('2ksports');
  echo $user['user_id'];
  echo $user['username'];
  echo $user['display_name'];
  echo $user['avatar'];
} catch(BadMethodCallException $be) {

} catch(Exception $e) {

}
```

## Implementation status

| Sleeper Class | Status |
| ------------- | :-----:|
| Avatars       |   100% |
| Drafts        |   100% |
| Leagues       |    78% |
| Players       |   100% |
| Users         |   100% |
