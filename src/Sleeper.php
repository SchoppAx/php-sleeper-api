<?php

namespace SchoppAx\Sleeper;

use SchoppAx\Sleeper\Http\Client;

class Sleeper
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
