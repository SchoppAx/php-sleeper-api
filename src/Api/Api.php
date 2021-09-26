<?php

namespace SchoppAx\Sleeper\Api;

use SchoppAx\Sleeper\Http\Client;

abstract class Api implements ApiInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
      $this->client = $client;
    }


    /**
     * @param string $path
     * @return json of called api resource
     * @throws SleeperException
     */
    public function get(string $path)
    {
      $response = $this->client->request('GET', $path);

      if ($response->getStatusCode() !== 200) {
        throw new SleeperHttpException($response->getStatusCode());
      } elseif ($response->getBody() === 'null') {
        throw new NullPointerException('The $var does not exist');
      }

      return json_decode($response->getBody(), true);
    }

}
