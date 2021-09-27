# sleeper-api-php-lib
========================

Sleeper API PHP library for consuming fantasy content from [official read-only Sleeper HTTP API](https://docs.sleeper.app/)

[![Build Status](https://www.travis-ci.org/SchoppAx/sleeper-api-php-lib.svg?branch=master)](https://www.travis-ci.org/SchoppAx/sleeper-api-php-lib)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SchoppAx/sleeper-api-php-lib/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SchoppAx/sleeper-api-php-lib/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/SchoppAx/sleeper-api-php-lib/badge.svg?branch=master)](https://coveralls.io/github/SchoppAx/sleeper-api-php-lib?branch=master)
[![Latest Stable Version](https://poser.pugx.org/schoppax/sleeper-api-php-lib/v/stable)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![Total Downloads](https://poser.pugx.org/schoppax/sleeper-api-php-lib/downloads)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![PHP from Packagist](https://poser.pugx.org/schoppax/sleeper-api-php-lib/require/php)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)
[![License](https://poser.pugx.org/schoppax/sleeper-api-php-lib/license.png)](https://packagist.org/packages/schoppax/sleeper-api-php-lib)


## Install

* If you're using Composer to manage dependencies, you can use

```sh
composer require schoppax/sleeper-api-php-lib
```

or add to your composer.json file:

    "require": {
        "schoppax/sleeper-api-php-lib": "1.*",
    }

# Example

``` php

use SchoppAx\Sleeper\SleeperClient;

$client = new SleeperClient();

try {
  $league = (object) $client->leagues()->find('289646328504385536');
} catch(BadMethodCallException $be) {

} catch(Exception $e) {

}

```
