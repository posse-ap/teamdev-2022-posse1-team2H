<?php

namespace modules\Utils;

class Utils
{
    public static function h($val) {
        return htmlspecialchars($val, ENT_QUOTES);
    }
}
