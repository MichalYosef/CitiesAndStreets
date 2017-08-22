<?php

$debugMode = true;


class App
{
    
    private $dbHandler = null;
    private $API;
    
   

   

    static function Instance()
    {
        
        static $inst = null;

        if ( $inst === null ) {
            $inst = new App();
        }
        
        return $inst;
    }
    
    private  function __construct()
    {
        if( ! $this->dbHandler){
            $this->dbHandler = Connection::Instance();
        }

        $this->API = new API( $this->dbHandler );
        
    }

    public function dbHandler()
    {
        return $this->dbHandler;
    }

    public function Run(){

    }


    static function log( $msg="An error occured", $killProcess=false )
    {
        if ( $GLOBALS['debugMode'] == true)
        {
            var_dump($msg);
        }

        if( $killProcess == true )
        {
            die();
        }


        /*
        echo "<script type='text/javascript'>alert('$msg');</script>";
        echo "Press back in browser...";

        */
    
    }

}




?>

