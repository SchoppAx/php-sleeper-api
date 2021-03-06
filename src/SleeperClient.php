<?php

namespace SchoppAx\Sleeper;

use SchoppAx\Sleeper\Http\Client;

class SleeperClient {
  private $client;

  public function __construct($mock = NULL)
  {
    $this->client = new Client($mock);
  }

  /**
   * @param string $method
   * @param string $parameters
   *
   * @method class avatars() retrieves avatar images for users and leagues
   * @method class drafts() retrieves all drafts by a user or league
   * @method class leagues() retrieves all leagues
   * @method class players() retrieves all players
   * @method class users() retrieve user object by name or id
   *
   * @throws BadMethodCallException
   */
  public function __call($method, array $parameters = [])
  {
    return $this->getApiInstance($method);
  }

  protected function getApiInstance($method): object
  {
    $class = "\\SchoppAx\\Sleeper\\Api\\".ucwords($method);

    if (class_exists($class)) {
        return new $class($this->client);
    }
    throw new \BadMethodCallException("Undefined method [{$method}] called.");
  }

}
