<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use SchoppAx\Sleeper\Api\Avatars;

class SleeperAvatarTest extends TestCase
{

  public function testAvatar()
  {
    $value = __DIR__ . '/data/740715586f5fecd032030346acf139c5.png';

    $mock = $this->createMock(Avatars::class);
    $mock->expects($this->once())
      ->method('find')
      ->willReturnCallback(function($id) use ($value) {
        return $value;
      });

    $client = $this->createPartialMock(SleeperClient::class, ['__call']);
    $client->expects($this->once())
      ->method('__call')
      ->willReturnCallback(function($name, $args) use ($mock) {
        return $mock;
      });

    $response = $client->avatars()->find('gg');

    $this->assertEquals('image/png', mime_content_type($response));
  }

}
