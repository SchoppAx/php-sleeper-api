<?php

namespace SchoppAx\Sleeper\Http;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class Client extends \GuzzleHttp\Client
{
  private const API_BASE = "https://api.sleeper.app/v1";

  public function __construct(MockHandler $mock = NULL)
  {
    if ($mock) {
      $handlerStack = HandlerStack::create($mock);
      parent::__construct(['handler' => $handlerStack]);
    } else {
      parent::__construct([
        'base_uri' => self::API_BASE,
        'headers' => [
          'Content-Type' => 'application/json'
        ]
      ]);
    }
  }

}
