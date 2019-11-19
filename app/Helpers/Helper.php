<?php

namespace App\Helpers;

class Helper
{
    public static function characterInfoBefore($phrase, $symbol, $count)
    {
        $result = '';
        for ($i=0; $i < strlen($phrase); $i++) {
            if($symbol == $phrase[$i]) {

                // if its the last character of the phrase
                if(($i == strlen($phrase)-1) && $count == 1){
                    $result .=  "none";
                } elseif ($i == strlen($phrase)-1){
                    $result .= "";
                } else {
                    $result .= $phrase[$i + 1];
                }
            }
        }
        return $result;
    }

    public static function characterInfoAfter($phrase, $symbol, $count)
    {
        $result = '';
        for ($i=0; $i < strlen($phrase); $i++) {
            if($symbol == $phrase[$i]) {
                if($i == 0 && $count == 1){
                    $result .= "none";
                }  elseif ($i == 0){
                    $result .= "";
                } else {
                    $result .= $phrase[$i - 1];
                }
            }
        }
        return $result;
    }

}