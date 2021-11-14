<?php

namespace SchoppAx\Sleeper\Api;

class Players extends Api
{
  /**
   * Fetch all players (nfl only)
   *
   * @return mixed object|resource|array|string|int|float|bool|null
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function all(): mixed
  {
    return $this->get('players/nfl');
  }
}
