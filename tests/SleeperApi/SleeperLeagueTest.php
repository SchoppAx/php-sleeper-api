<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class SleeperLeagueTest extends TestCase
{

  public function testLeague()
  {
    $data = file_get_contents(__DIR__ . '/data/league.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $league = (object) $client->leagues()->find('289646328504385536');

    $this->assertIsObject($league);
    $this->assertEquals('289646328504385536', $league->league_id);
    $this->assertEquals('Sleeper Friends League', $league->name);
    $this->assertEquals('2018', $league->season);
    $this->assertCount(15, $league->roster_positions);
    $this->assertIsArray($league->settings);
  }

  public function testLeagues()
  {
    $data = file_get_contents(__DIR__ . '/data/leagues.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $leagues = $client->leagues()->byUser('457511950237696', 2018);
    $league = (object) $leagues[0];

    $this->assertIsArray($leagues);
    $this->assertCount(2, $leagues);
    $this->assertEquals('337383787396628480', $league->league_id);
    $this->assertEquals('Dynasty Warriors', $league->name);
    $this->assertEquals('2018', $league->season);
    $this->assertCount(18, $league->roster_positions);
    $this->assertIsArray($league->settings);
  }

  public function testLeaguesSeasonException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("byUser function only accepts seasons since 2015 and sport type 'nfl'. Inputs were: 1988, nfl");

    $client->leagues()->byUser('457511950237696', 1988);
  }

  public function testLeaguesSportException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("byUser function only accepts seasons since 2015 and sport type 'nfl'. Inputs were: 2018, none");

    $client->leagues()->byUser('457511950237696', 2018, 'none');
  }

  public function testState()
  {
    $data = file_get_contents(__DIR__ . '/data/state.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $state = (object) $client->leagues()->state();

    $this->assertIsObject($state);
    $this->assertEquals(2, $state->week);
    $this->assertEquals('2021-09-09', $state->season_start_date);
    $this->assertEquals('2020', $state->previous_season);
    $this->assertEquals('2021', $state->season);
  }

  public function testStateException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("state function only accepts sports like nfl, nba, lcs. Input was: none");

    $client->leagues()->state('none');
  }

  public function testUsers()
  {
    $data = file_get_contents(__DIR__ . '/data/users.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $users = $client->leagues()->users('289646328504385536');
    $user = (object) $users[0];

    $this->assertIsArray($users);
    $this->assertCount(14, $users);
    $this->assertEquals('457511950237696', $user->user_id);
    $this->assertTrue($user->is_owner);
    $this->assertEquals('2KSports', $user->display_name);
  }

  public function testMatchup()
  {
    $data = file_get_contents(__DIR__ . '/data/matchups.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $matchups = $client->leagues()->matchups('337383787396628480', 3);
    $matchup = (object) $matchups[0];

    $this->assertIsArray($matchups);
    $this->assertCount(12, $matchups);
    $this->assertEquals(108.9, $matchup->points);
    $this->assertIsArray($matchup->starters);
    $this->assertIsArray($matchup->players);
  }

  public function testMatchupWeekException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("matchups function only accepts weeks between 1 and 16. Input was: 0");

    $client->leagues()->matchups('337383787396628480', 0);
  }

  public function testRoster()
  {
    $data = file_get_contents(__DIR__ . '/data/rosters.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $rosters = $client->leagues()->rosters('337383787396628480');
    $roster = (object) $rosters[0];

    $this->assertIsArray($rosters);
    $this->assertCount(12, $rosters);
    $this->assertEquals('189140835533586432', $roster->owner_id);
    $this->assertEquals('289646328504385536', $roster->league_id);
    $this->assertIsArray($roster->settings);
    $this->assertEquals(7, $roster->settings['wins']);
    $this->assertEquals(6, $roster->settings['losses']);
  }

  public function testLosersBracket()
  {
    $data = file_get_contents(__DIR__ . '/data/playoff-bracket-loser.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $bracket = $client->leagues()->losersBracket('289646328504385536');
    $firstMatchup = (object) $bracket[0];
    $secondMatchup = (object) $bracket[2];

    $this->assertIsArray($bracket);
    $this->assertCount(7, $bracket);
    $this->assertEquals(7, $firstMatchup->w);
    $this->assertEquals(1, $firstMatchup->r);
    $this->assertEquals(1, $secondMatchup->t2_from['w']);
    $this->assertEquals(7, $secondMatchup->l);
    $this->assertEquals(11, $secondMatchup->w);
  }

  public function testWinnersBracket()
  {
    $data = file_get_contents(__DIR__ . '/data/playoff-bracket-winner.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $bracket = $client->leagues()->winnersBracket('289646328504385536');
    $firstMatchup = (object) $bracket[0];
    $secondMatchup = (object) $bracket[3];

    $this->assertIsArray($bracket);
    $this->assertCount(7, $bracket);
    $this->assertEquals(1, $firstMatchup->w);
    $this->assertEquals(5, $firstMatchup->t1);
    $this->assertEquals(2, $secondMatchup->t2_from['w']);
    $this->assertEquals(2, $secondMatchup->l);
    $this->assertEquals(3, $secondMatchup->w);
  }

  public function testTransactions()
  {
    $data = file_get_contents(__DIR__ . '/data/transactions.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $transactions = $client->leagues()->transactions('289646328504385536', 1);
    $firstTransaction = (object) $transactions[0];
    $secondTransaction = (object) $transactions[2];

    $this->assertIsArray($transactions);
    $this->assertEquals('Unfortunately, your roster will have too many players after this transaction.', $firstTransaction->metadata['notes']);
    $this->assertEquals('waiver', $firstTransaction->type);
    $this->assertEquals('failed', $firstTransaction->status);
    $this->assertEquals('Your waiver claim was processed successfully!', $secondTransaction->metadata['notes']);
    $this->assertEquals('waiver', $secondTransaction->type);
    $this->assertEquals('complete', $secondTransaction->status);
  }

  public function testTransactionsRoundException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("transactions function only accepts rounds between 1 and 16. Input was: 17");

    $client->leagues()->transactions('289646328504385536', 17);
  }

  public function testTradedPicks()
  {
    $data = file_get_contents(__DIR__ . '/data/traded-picks.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $picks = $client->leagues()->tradedPicks('289646328504385536');
    $firstTrade = (object) $picks[0];

    $this->assertIsArray($picks);
    $this->assertEquals('2019', $firstTrade->season);
    $this->assertEquals(5, $firstTrade->round);
    $this->assertEquals(1, $firstTrade->roster_id);
    $this->assertEquals(1, $firstTrade->previous_owner_id);
    $this->assertEquals(2, $firstTrade->owner_id);
  }

}
