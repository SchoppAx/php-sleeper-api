php-sleeper-api
===================

[![Build Status](https://github.com/schoppax/php-sleeper-api/actions/workflows/php.yml/badge.svg)](https://github.com/schoppax/php-sleeper-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SchoppAx/php-sleeper-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SchoppAx/php-sleeper-api/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/SchoppAx/php-sleeper-api/badge.svg?branch=master)](https://coveralls.io/github/SchoppAx/php-sleeper-api?branch=master)

[![PHP from Packagist](https://poser.pugx.org/schoppax/php-sleeper-api/require/php)](https://packagist.org/packages/schoppax/php-sleeper-api)
[![Latest Stable Version](https://poser.pugx.org/schoppax/php-sleeper-api/v/stable)](https://packagist.org/packages/schoppax/php-sleeper-api)
[![Total Downloads](https://poser.pugx.org/schoppax/php-sleeper-api/downloads)](https://packagist.org/packages/schoppax/php-sleeper-api)
[![License](https://poser.pugx.org/schoppax/php-sleeper-api/license.png)](https://packagist.org/packages/schoppax/php-sleeper-api)

Sleeper API PHP library for consuming fantasy content from [official read-only Sleeper HTTP API](https://docs.sleeper.app/)

# Installation

If you're using Composer to manage dependencies, you can run the following command:

```sh
$ composer require schoppax/php-sleeper-api
```

or add the following to your composer.json file:
```json
"require": {
  "schoppax/php-sleeper-api": "1.*",
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
