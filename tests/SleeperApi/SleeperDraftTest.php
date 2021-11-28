<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class SleeperDraftTest extends TestCase
{

  public function testUser()
  {
    $data = file_get_contents(__DIR__ . '/data/draft.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $draft = (object) $client->drafts()->byUser('457511950237696', '2018');

    $this->assertIsObject($draft);
    $this->assertEquals('289646328504385536', $draft->league_id);
    $this->assertIsArray($draft->metadata);
    $this->assertEquals('Sleeper Friends League', $draft->metadata['name']);
    $this->assertEquals('2018', $draft->season);
    $this->assertEquals('snake', $draft->type);
    $this->assertCount(12, $draft->settings);
    $this->assertEquals(12, $draft->settings['teams']);
    $this->assertEquals('289646328508579840', $draft->draft_id);
  }

  public function testUserSeasonException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("byUser function only accepts seasons since 2015 and sport type 'nfl'. Inputs were: 1988, nfl");

    $client->drafts()->byUser('457511950237696', 1988);
  }

  public function testUserSportException()
  {
    $response = new GuzzleHttp\Psr7\Response(200, [], null);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("byUser function only accepts seasons since 2015 and sport type 'nfl'. Inputs were: 2018, none");

    $client->drafts()->byUser('457511950237696', 2018, 'none');
  }

  public function testLeague()
  {
    $data = file_get_contents(__DIR__ . '/data/league-drafts.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $drafts = $client->drafts()->byLeague('289646328504385536');
    $draft = (object) $drafts[0];

    $this->assertIsArray($drafts);
    $this->assertCount(1, $drafts);
    $this->assertIsObject($draft);
    $this->assertEquals('289646328504385536', $draft->league_id);
    $this->assertIsArray($draft->metadata);
    $this->assertEquals('Sleeper Friends League', $draft->metadata['name']);
    $this->assertEquals('2018', $draft->season);
    $this->assertEquals('snake', $draft->type);
    $this->assertCount(12, $draft->settings);
    $this->assertEquals(12, $draft->settings['teams']);
    $this->assertEquals('289646328508579840', $draft->draft_id);
  }

  public function testDraft()
  {
    $data = file_get_contents(__DIR__ . '/data/draft.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $draft = (object) $client->drafts()->find('289646328508579840');

    $this->assertIsObject($draft);
    $this->assertEquals('289646328504385536', $draft->league_id);
    $this->assertIsArray($draft->metadata);
    $this->assertEquals('Sleeper Friends League', $draft->metadata['name']);
    $this->assertEquals('2018', $draft->season);
    $this->assertEquals('snake', $draft->type);
    $this->assertCount(12, $draft->settings);
    $this->assertEquals(12, $draft->settings['teams']);
    $this->assertEquals('289646328508579840', $draft->draft_id);
  }

  public function testPick()
  {
    $data = file_get_contents(__DIR__ . '/data/draft-picks.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $picks = $client->drafts()->picks('289646328508579840');
    $pick = (object) $picks[3];

    $this->assertIsArray($picks);
    $this->assertCount(180, $picks);
    $this->assertIsObject($pick);
    $this->assertEquals(1, $pick->round);
    $this->assertEquals(12, $pick->roster_id);
    $this->assertIsArray($pick->metadata);
    $this->assertEquals('Ezekiel', $pick->metadata['first_name']);
    $this->assertEquals('Elliott', $pick->metadata['last_name']);
    $this->assertEquals('3164', $pick->player_id);
    $this->assertEquals(4, $pick->draft_slot);
    $this->assertEquals('3975968863961088', $pick->picked_by);
    $this->assertEquals('289646328508579840', $pick->draft_id);
  }

  public function testTrade()
  {
    $data = file_get_contents(__DIR__ . '/data/draft-traded-picks.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $trades = $client->drafts()->tradedPicks('289646328508579840');

    $this->assertIsArray($trades);
    $this->assertCount(0, $trades);
  }

}
