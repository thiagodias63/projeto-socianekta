<?php
/**
 * User: thiagodias63
 * Date: 10/04/20
 * Time: 20:28
 */

namespace app\helpers;

class FormatHelper
{
    public static $telefoneRemovePattern = "/(\(|\)|\s|-)/";

    public static function DateToShow($date) {
        return date("d/m/Y", strtotime($date));
    }

    public static function DateToInsert($date) {
        $new_date = \DateTime::createFromFormat("d/m/Y", $date);
        return $new_date->format("Y-m-d");
    }
    
    public static function removeTelefoneMask($input) {
        return preg_replace(self::$telefoneRemovePattern,"",$input);
    }
    public static function removeCpfMask($input) {
        $input = str_replace(".", "", $input);
        $input = str_replace("-", "", $input);
        return $input;
    }

    
}