<?php

namespace SchoppAx\Sleeper\Api;

class Avatars extends Api
{

    /**
     * @param string $avatarId
     * @return object thumbnail images for each avatar
     * @throws SleeperException
     */
    public function find(string $avatarId)
    {
      return $this->get('avatars/thumbs/' . $avatarId);
    }

}
