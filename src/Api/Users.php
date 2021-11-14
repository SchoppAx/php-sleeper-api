<?php

namespace SchoppAx\Sleeper\Api;

class Users extends Api
{

  /**
   * @param string $identifier username or user_id
   * @return array
   * @throws ClientException if status code <> 200
   * @throws Exception if response body equals null
   */
  public function find(string $identifier): array
  {
      return $this->get('user/' . $identifier);
  }

}
