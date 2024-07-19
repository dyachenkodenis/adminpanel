<?php

namespace App\Services;



class GetCheckedWidget
{
    public static function in_checked($id, $widgets)
    {
        $r = json_decode($widgets, true);
        if(isset($r) && $r){
            foreach($r as $dd){
                if ($dd['id'] == $id) {             
                return $id;
                } else {
                
                }
            }//end foreach
        }//end if
      
    }
}
