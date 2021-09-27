<?php

namespace SchoppAx\Sleeper;

use SchoppAx\Sleeper\Http\Client;

class SleeperClient
{
  private Client $client;

  public function __construct($mock = NULL)
  {
    $this->client = new Client($mock);
  }

  /**
   * @param string $method
   * @param string $parameters
   * @return class
   *
   * @method class Avatars() retrieves avatar images for users and leagues
   * @method class Drafts() retrieves all drafts by a user or league
   * @method class leagues() retrieves all leagues
   * @method class Players() retrieves all players
   * @method class Users() retrieve user object by name or id
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
