<?php

namespace SchoppAx\Sleeper\Api;

use SchoppAx\Sleeper\Api\Utility\Validation;

class Players extends Api
{
  /**
   * Fetch all players (nfl only)
   *
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function all(): array
  {
    return $this->get('players/nfl');
  }

  /**
   * Get a list of trending players based on adds or drops
   *
   * @param string $type
   * @param string $sport
   * @param int $hours
   * @param int $limit
   *
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function trending(string $type, string $sport = 'nfl', int $hours = 24, int $limit = 25): array
  {
    $type = strtolower($type);
    if(!Validation::contains(['add', 'drop'], $type)) {
      throw new \InvalidArgumentException("trending function only accepts type 'add' or 'drop'. Input was: {$type}");
    } elseif(!Validation::contains($this->sports, $sport)) {
      $strSupported = join(", ", $this->sports);
      throw new \InvalidArgumentException("trending function only accepts sports like {$strSupported}. Input was: {$sport}");
    } elseif(!Validation::between($hours, 1, 24)) {
      throw new \InvalidArgumentException("trending function only accepts hours between 1 and 24. Input was: {$hours}");
    } elseif(!Validation::between($limit, 1, 200)) {
      throw new \InvalidArgumentException("trending function only accepts limits between 1 and 200. Input was: {$limit}");
    }

    return $this->get('players/'. $sport .'/trending/'. $type .'?lookback_hours='. $hours .'&limit='. $limit);
  }

}
