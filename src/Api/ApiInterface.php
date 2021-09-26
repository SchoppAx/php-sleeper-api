<?php

namespace SchoppAx\Sleeper\Api;

interface ApiInterface
{

  /**
   * @param string $path
   */
  public function get(string $path);
}
