<?php

namespace SchoppAx\Sleeper\Api;

use Throwable;

class SleeperHttpException extends \Exception
{

  /**
   * List of HTTP status codes
   *
   * From https://docs.sleeper.app/#errors
   *
   * @var array
   */
  private $status = array(
      400 => 'Bad Request - Your request is invalid.',
      404 => 'Not Found - The specified kitten could not be found.',
      429 => "Too Many Requests - You're requesting too many kittens! Slow down!",
      500 => 'Internal Server Error - We had a problem with our server. Try again later.',
      503 => "Service Unavailable - We're temporarily offline for maintenance. Please try again later."
  );

  /**
   * @param int[optional]    $statusCode   If NULL will use 500 as default
   * @param string[optional] $statusMsg If NULL will use the default status phrase
   */
  public function __construct($statusCode = 500, $statusMsg = null)
  {
    if (null === $statusMsg && isset($this->status[$statusCode])) {
      $statusMsg = $this->status[$statusCode];
    }
    parent::__construct($statusMsg, $statusCode);
  }

}
