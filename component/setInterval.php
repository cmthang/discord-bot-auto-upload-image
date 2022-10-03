<?php

    setInterval(function (){

    },1000);

    function setInterval($f, $milliseconds)
        {
            $seconds=(int)$milliseconds/1000;
            while(true)
            {
                $f();
                sleep($seconds);
            }
        }

?>