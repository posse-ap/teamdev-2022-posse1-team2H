<?php

namespace modules\utils;

class Utils
{
    public static function h($val) {
        return htmlspecialchars($val, ENT_QUOTES);
    }

    public static function gender($val) {
        if ($val == 1) {
            return "男性";
        } else if ($val == 2) {
            return "女性";
        } else {
            return "中性";
        }
    }
}
