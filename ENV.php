<?php

namespace App;

class ENV
{
    public static function getValue($key){

        $content = explode("\n",file_get_contents('.env'));
        foreach ($content as $row){
            $item = explode("=",$row);


            if($key == $item[0]) return $item[1];
        }
    }
    public static function getBool($key){
         return filter_var(self::getValue($key), FILTER_VALIDATE_BOOLEAN);

    }
}