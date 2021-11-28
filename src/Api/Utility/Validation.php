<?php

namespace SchoppAx\Sleeper\Api\Utility;

class Validation
{

    /**
     * @param int $val
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function between(int $val, int $min, int $max)
    {
      return ($val >= $min && $val <= $max);
    }

    /**
     * @param array $arr
     * @param string $val
     * @return bool (json) of called api resource
     */
    public static function contains(array $arr, string $val)
    {
      return in_array($val, $arr);
    }

}
