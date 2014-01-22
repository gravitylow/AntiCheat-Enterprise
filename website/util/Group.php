<?php

class Group {

    private static $colors = array(
        "BLACK"       => "000000",
        "DARK_BLUE"   => "0404B4",
        "DARK_GREEN"  => "0B610B",
        "DARK_AQUA"   => "0B3861",
        "DARK_RED"    => "610B0B",
        "DARK_PURPLE" => "380B61",
        "GOLD"        => "DF7401",
        "GRAY"        => "585858",
        "DARK_GRAY"   => "2E2E2E",
        "BLUE"        => "0080FF",
        "GREEN"       => "00FF00",
        "AQUA"        => "00BFFF",
        "RED"         => "FF0000",
        "LIGHT_RED"   => "FE2E2E",
        "YELLOW"      => "FFFF00",
        "WHITE"       => "FFFFFF",
    );

    public static function getWebColor($color) {
        foreach(self::$colors as $key => $value){
            if($key === $color) {
                return $value;
            }
        }
        return "FFFFFF";
    }
}

