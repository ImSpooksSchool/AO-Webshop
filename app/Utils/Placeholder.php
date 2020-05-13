<?php
/**
 * Created by Nick on 13 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Utils;


class Placeholder {

    public static function replace(string $string, array $placeholders = []): string {
        foreach ($placeholders as $key => $value) {
            $string = str_replace("{" . $key . "}" , $value, $string);
        }
        return $string;
    }
}
