<?php

namespace SchoppAx\Sleeper\Api;

class Drafts extends Api
{

  /**
   * @param string $userId
   * @param string $season
   * @param string[optional] $sport default is nfl
   * @return array|[]
   * @throws SleeperException
   */
  public function byUser(string $userId, string $season, string $sport = 'nfl'): array
  {
    return $this->get('user/' . $userId . '/leagues/'. $sport .'/' . $season);
  }

  /**
   * @param string $leagueId
   * @return array|[]
   * @throws SleeperException
   */
  public function byLeague(string $leagueId): array
  {
    return $this->get('league/'. $leagueId .'/drafts');
  }

  /**
   * @param string $draftId
   * @return array|[]
   * @throws SleeperException
   */
  public function find(string $draftId): array
  {
    return $this->get('/draft/' . $draftId);
  }

  /**
   * @param string $draftId
   * @return array|[]
   * @throws SleeperException
   */
  public function picks(string $draftId): array
  {
    return $this->get('/draft/' . $draftId .'/picks');
  }

  /**
   * @param string $draftId
   * @return array|[]
   * @throws SleeperException
   */
  public function tradedPicks(string $draftId): array
  {
    return $this->get('/draft/' . $draftId .'/traded_picks');
  }

}
