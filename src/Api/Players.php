<?php

namespace SchoppAx\Sleeper\Api;

class Players extends Api
{
  /**
   * Fetch all players (nfl only)
   *
   * @return array|[]
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function all(): array
  {
    return $this->get('players/nfl');
  }
}
