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
     * @throws Exception
     */
    public function get(string $path)
    {
      $response = $this->client->request('GET', $path);

      if ($response->getStatusCode() !== 200) {
        throw new Exception('Statuscode <> 200', $response->getStatusCode());
      } elseif ($response->getBody() === 'null') {
        throw new Exception('The response body does not exist');
      }

      return json_decode($response->getBody(), true);
    }

}
