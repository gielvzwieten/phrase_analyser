<?php

namespace App\Helpers;

class Helper
{
    public static function characterInfoBefore($phrase, $symbol, $count)
    {
        for ($i=0; $i < strlen($phrase); $i++) {
            if($symbol == $phrase[$i]) {

                // if its the last character of the phrase
                if(($i == strlen($phrase)-1) && $count == 1){
                    return "none";
                } elseif ($i == strlen($phrase)-1){
                    return "";
                } else {
                    return $phrase[$i + 1];
                }
            }
        }
    }

    public static function characterInfoAfter($phrase, $symbol, $count)
    {
        for ($i=0; $i < strlen($phrase); $i++) {
            if($symbol == $phrase[$i]) {
                if($i == 0 && $count == 1){
                    return "none";
                }  elseif ($i == 0){
                    return "";
                } else {
                    return $phrase[$i - 1];
                }
            }
        }
    }

//    public static function traverseGraph($phrase, $uniqueCharsInPhrase, $uniqueCharsPushedToArray)
//    {
//
//    }

}