<?php

namespace SchoppAx\Sleeper\Api;

class Players extends Api
{
  /**
   * @return array|[]
   * @throws SleeperException
   */
  public function all(): array
  {
    return $this->get('players/nfl');
  }
}
