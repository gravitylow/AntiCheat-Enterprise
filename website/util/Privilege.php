<?php

class Privilege {

    public static function hasSuperAdmin($privilege) {
        return $privilege == "superadmin";
    }

    public static function hasAdmin($privilege) {
        return $privilege == "superadmin" || $privilege == "admin";
    }
}

