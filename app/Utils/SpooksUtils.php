<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Utils;

class SpooksUtils {

    /**
     * @param $value
     * @param $default
     * @return mixed
     */
    public static function getOrDefault($value, $default) {
        if (isset($value))
            return $value;
        return $default;
    }
}
