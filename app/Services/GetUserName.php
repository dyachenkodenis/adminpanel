<?php

namespace App\Services;

use App\Models\User;

class GetUserName{
    public static function name($id)
    {
        
      
        $user = User::find($id);

        if($user){
            $user = $user->toArray();
            if(strpos($user['name'], '_deleted') !== false){
            
                return $user['name'];
            
            }else{
                return $user['name'];
            }
        }
    }
}