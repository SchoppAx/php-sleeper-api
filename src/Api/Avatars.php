<?php

namespace SchoppAx\Sleeper\Api;

class Avatars extends Api
{

    /**
     * @param string $avatarId
     * @return object thumbnail images for each avatar
     * @throws ClientException if status code <> 200
     * @throws Exception if response body equals null
     */
    public function find(string $avatarId)
    {
      return $this->get('avatars/thumbs/' . $avatarId);
    }
}
