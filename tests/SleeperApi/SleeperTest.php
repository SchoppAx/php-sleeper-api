<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\Sleeper;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class SleeperTest extends TestCase
{

  public function testLeague()
  {
    $data = file_get_contents(__DIR__ . '/data/league.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new Sleeper($mock);

    $league = (object) $client->leagues()->find('289646328504385536');

    $this->assertIsObject($league);
    $this->assertEquals('289646328504385536', $league->league_id);
    $this->assertEquals('Sleeper Friends League', $league->name);
    $this->assertEquals('2018', $league->season);
    $this->assertCount(15, $league->roster_positions);
    $this->assertIsArray($league->settings);
  }

}
