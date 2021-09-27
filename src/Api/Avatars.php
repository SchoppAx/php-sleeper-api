<?php

namespace SchoppAx\Sleeper\Api;

class Avatars
{

    /**
     * @param string $avatarId
     * @param bool[optional] $thumbnail
     *
     * @return string image link for each avatar
     * @throws ClientException if status code <> 200
     * @throws Exception if response body equals null
     */
    public function find(string $avatarId, bool $thumbnail = false)
    {
      if ($thumbnail) {
        $avatarId = 'thumbs/'. $avatarId;
      }
      return 'https://sleepercdn.com/avatars/'. $avatarId;
    }
}
