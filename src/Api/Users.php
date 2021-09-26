<?php

namespace SchoppAx\Sleeper\Api;

class Users extends Api
{

  /**
   * @param string $identifier username or user_id
   * @return array|[]
   * @throws SleeperException
   */
  public function find(string $identifier): array
  {
      return $this->get('user/' . $identifier);
  }

}
