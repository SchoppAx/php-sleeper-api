<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class SleeperExceptionTest extends TestCase
{

  public function testBadMethodException() {
    $client = new SleeperClient();

    $this->expectException(BadMethodCallException::class);

    $client->TestClass();
  }

  public function testSleeperHttpException() {
    $response = new GuzzleHttp\Psr7\Response(429, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Client error: `GET league/289646328504385536` resulted in a `429 Too Many Requests` response');

    $client->leagues()->find('289646328504385536');
  }

  public function testSleeperHttpException2() {
    $response = new GuzzleHttp\Psr7\Response(302, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Client error: `GET league/289646328504385536` resulted in a 302 response');

    $client->leagues()->find('289646328504385536');
  }

  public function testSleeperHttpException3() {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Client error: `GET league/289646328504385536` resulted in a empty response body');

    $client->leagues()->find('289646328504385536');
  }

}
