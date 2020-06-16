<?php


class Activate {
    
    function createActivationCode(){
        $kod = "";
        for($i=1;$i<=7; $i++){
            $kod .= strval(rand(0,9));
        }
        return $kod;
    }



}

?>