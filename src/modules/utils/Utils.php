<?php

namespace modules\utils;

class Utils
{
    public static function h($val) {
        return htmlspecialchars($val, ENT_QUOTES);
    }
}
