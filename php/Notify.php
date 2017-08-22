<?php


class Notify
{
    private  function __construct(){}  
        
    static function AlertSuccess( $msg, $nextPageUrl="main.php" )
    {    
        echo '<div class="alert alert-success">' . $msg . '</div>';
        header('"Refresh: 3; URL="' . $nextPageUrl . '"');
    }
    
    static function AlertError($msg , $nextPageUrl )
    {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
        header('"Refresh: 3; URL="' . $nextPageUrl . '"');
    }


    static function log( $msg="An error occured", $killProcess=false )
    {
        if ( $GLOBALS['debugMode'] == true )
        {
            var_dump( $msg );
        }

        if( $killProcess == true )
        {
            die();
        }

    }

}




?>

