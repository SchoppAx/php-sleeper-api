<?php

namespace SchoppAx\Sleeper\Api;

use SchoppAx\Sleeper\Http\Client;

abstract class Api implements ApiInterface
{
    private $client;

    public function __construct(Client $client)
    {
      $this->client = $client;
    }


    /**
     * @param string $path
     * @return json of called api resource
     * @throws Exception
     */
    public function get(string $path)
    {
      $response = $this->client->request('GET', $path);

      if ($response->getStatusCode() !== 200) {
        throw new \Exception('Client error: `GET '. $path .'` resulted in a '. $response->getStatusCode() .' response');
      } elseif ($response->getBody()->getSize() === 0) {
        throw new \Exception('Client error: `GET '. $path .'` resulted in a empty response body');
      }

      return json_decode($response->getBody(), true);
    }

}
