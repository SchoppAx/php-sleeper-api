<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use SchoppAx\Sleeper\Api\Avatars;

class SleeperAvatarTest extends TestCase
{

  private function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    $result = curl_exec($curl);
    $ret = false;

    //if request did not fail
    if ($result !== false) {
      //if request was ok, check response code
      $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

      if ($statusCode == 200) {
        $ret = true;
      }
    }

    curl_close($curl);

    return $ret;
  }

  public function testAvatar()
  {
    $client = new SleeperClient();

    $url = $client->avatars()->find('79f5f8ecdd59fe94b668993366552b3a');
    $exists = $this->remoteFileExists($url);

    $this->assertIsBool($exists);
    $this->assertEquals($exists, true);
  }

}
