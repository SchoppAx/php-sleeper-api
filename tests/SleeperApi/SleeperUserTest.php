<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class SleeperUserTest extends TestCase
{

  public function testUser()
  {
    $data = file_get_contents(__DIR__ . '/data/user.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $user = (object) $client->users()->find('2ksports');

    $this->assertIsObject($user);
    $this->assertEquals('457511950237696', $user->user_id);
    $this->assertEquals('2ksports', $user->username);
    $this->assertEquals('2KSports', $user->display_name);
  }

}
