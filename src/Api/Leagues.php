<?php

namespace SchoppAx\Sleeper\Api;

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
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function byUser(string $userId, string $season, string $sport = 'nfl'): array
  {
    return $this->get('user/' . $userId . '/leagues/'. $sport .'/' . $season);
  }


  /**
   * @param string $leagueId
   * @param string $week
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function matchups(string $leagueId, string $week): array
  {
    return $this->get('league/' . $leagueId . '/matchups/' . $week);
  }

  /**
   * @param string[optional] $sport default is nfl
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function state(string $sport = 'nfl'): array
  {
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

}
