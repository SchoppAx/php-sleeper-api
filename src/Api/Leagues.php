<?php

namespace SchoppAx\Sleeper\Api;

use SchoppAx\Sleeper\Api\Utility\Validation;

class Leagues extends Api
{

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function find(string $leagueId): array
  {
    return $this->get('league/' . $leagueId);
  }

  /**
   * @param string $userId
   * @param string $season
   * @param string[optional] $sport default is nfl
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function byUser(string $userId, string $season, string $sport = 'nfl'): array
  {
    if(!Validation::between($season, 2015, date("Y")) || !Validation::contains(['nfl'], $sport)) {
      throw new \InvalidArgumentException("byUser function only accepts seasons since 2015 and sport type 'nfl'. Inputs were: {$season}, {$sport}");
    }

    return $this->get('user/' . $userId . '/leagues/'. $sport .'/' . $season);
  }

  /**
   * @param string $leagueId
   * @param string $week
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function matchups(string $leagueId, string $week): array
  {
    if(!Validation::between($week, 1, 16)) {
      throw new \InvalidArgumentException("matchups function only accepts weeks between 1 and 16. Input was: {$week}");
    }

    return $this->get('league/' . $leagueId . '/matchups/' . $week);
  }

  /**
   * @param string[optional] $sport default is nfl
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function state(string $sport = 'nfl'): array
  {
    $supported = ['nfl', 'nba', 'lcs'];
    if(!Validation::contains($supported, $sport)) {
      $strSupported = join(", ", $supported);
      throw new \InvalidArgumentException("state function only accepts sports like {$strSupported}. Input was: {$sport}");
    }

    return $this->get('state/'. $sport);
  }

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function users(string $leagueId): array
  {
    return $this->get('league/' . $leagueId . '/users');
  }

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function rosters(string $leagueId): array
  {
    return $this->get('league/' . $leagueId . '/rosters');
  }

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function winnersBracket(string $leagueId): array
  {
    return $this->get('league/' . $leagueId . '/winners_bracket');
  }

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function losersBracket(string $leagueId): array
  {
    return $this->get('league/' . $leagueId . '/losers_bracket');
  }

  /**
   * @param string $leagueId
   * @param int $round
   * @return array
   * @throws InvalidArgumentException if params doesn't match
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function transactions(string $leagueId, int $round): array
  {
    if(!Validation::between($round, 1, 16)) {
      throw new \InvalidArgumentException("transactions function only accepts rounds between 1 and 16. Input was: {$round}");
    }

    return $this->get('league/' . $leagueId . '/transactions/' . $round);
  }

  /**
   * @param string $leagueId
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function tradedPicks(string $leagueId): array
  {
    return $this->get('league/' . $leagueId . '/traded_picks');
  }

}
