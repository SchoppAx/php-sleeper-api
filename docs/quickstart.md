# Quick start

It is recommended to install `schoppax/php-sleeper-api` using composer to manage dependencies. You can run the following command:

```sh
$ composer require schoppax/php-sleeper-api
```

or add the following to your composer.json file:
```json
"require": {
  "schoppax/php-sleeper-api": "1.*",
}
```


## Initialize

After that you can just add the namespace and create a new instance of the `SleeperClient` class.

```php
use SchoppAx\Sleeper\SleeperClient;

$client = new SleeperClient();
```

Now you are ready to go.

## Manual initialization

You don't like `composer` or have trouble installing it?
With effort you can manually install the dependencies.

To do so, you can use [PHP download](https://php-download.com/) to get all dependencies. Just type `schoppax/php-sleeper-api` into the search bar and download the library by choosing the download type *require*.

Extract the ZIP file, open the `index.php` and add the autoload code to the file:
```php
<?php
  require_once('vendor/autoload.php');
```
