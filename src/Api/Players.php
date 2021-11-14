<?php

namespace SchoppAx\Sleeper\Api;

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
   * @param string $hours
   * @param string $limit
   *
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function trending(string $type, string $sport = 'nfl', int $hours = 24, int $limit = 25): array
  {
    $type = strtolower($type);
    if($type !== 'add' && $type !== 'drop') {
      throw new \InvalidArgumentException('trending function only accepts type "add" or "drop". Input was: '. $type);
    }

    return $this->get('players/'. $sport .'/trending/'. $type .'?lookback_hours='. $hours .'&limit='. $limit);
  }

}
