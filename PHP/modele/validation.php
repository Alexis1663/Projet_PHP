<?php

class Validation{

    private string $str1;

    public function cleanString($str){

        $str1 = filter_var($str,FILTER_SANITIZE_STRING);
        echo $str1;
    }

}

?>