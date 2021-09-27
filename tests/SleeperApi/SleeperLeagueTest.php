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

    $leagues = $client->leagues()->byUser('457511950237696', '2018');
    $league = (object) $leagues[0];

    $this->assertIsArray($leagues);
    $this->assertCount(2, $leagues);
    $this->assertEquals('337383787396628480', $league->league_id);
    $this->assertEquals('Dynasty Warriors', $league->name);
    $this->assertEquals('2018', $league->season);
    $this->assertCount(18, $league->roster_positions);
    $this->assertIsArray($league->settings);
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

}
