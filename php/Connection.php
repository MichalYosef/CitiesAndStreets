<?php

class Connection{

    private $host;
    private $dbName;
    private $user;
    private $password;
    private $charset;
    private $opt; //A key=>value array of driver-specific connection options.
    private $dbConnection; //pdo
    private $dsn; /*The Data Source Name, or DSN, contains the information required to connect to the database.*/
        
    static function Instance()
    {
        
        static $inst = null;

        if ( $inst === null ) {
            $inst = new Connection();
        }
        
        return $inst;
    }

    private function __construct( $user = 'root',
                                 $password = '',
                                 $host = '127.0.0.1',
                                 $dbName   = 'northwind',
                                 $charset = 'utf8',
                                 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                         PDO::ATTR_EMULATE_PREPARES   => false]
                                )
    {
        $this->host    = $host;
        $this->dbName  = $dbName;
        $this->user    = $user;
        $this->password= $password;
        $this->charset = $charset;
        $this->opt     = $opt;
        
    
        $this->dsn = "mysql:host=" . $host . ";dbname=" . $dbName . ";charset=" . $charset;
        
        $this->connect();
       
    }

    private function connect()
    {
        try{

            $this->dbConnection = new PDO( $this->dsn, $this->user, $this->password, $this->opt );
            

        }catch( PDOException $e) {

            Error::log( 'Connection failed:  exception was thrown: ' . $e->getMessage() );
        }
        
    }

    public function getDbConnection()
    {
        if( $this->dbConnection == null)
        {
            $this->connect();
        }

        return $this->dbConnection;
    }

    public function runSql( $sqlQuery, $arrParams=null )
    {
        $this->getDbConnection();
        
       
        try{

            $statement = $this->dbConnection->prepare( $sqlQuery );
            

        }catch( PDOException $e) {

            Error::log( 'pdo->prepare failed:  exception was thrown: ' . $e->getMessage() );
        }
       
        
        
        if( !$statement )
        {
            App::log( "Database Error. <br> server cannot prepare the statement from query: ".$sqlQuery);
            return false;
        }

         try{
            if(! $statement->execute($arrParams))
            {
                App::log( "DB error ocuured. can not execute statement".$statement);
                return false;
            }
        }catch( PDOException $e) {
            App::log( 'execute to db failed. exception was thrown: ' . $e->getMessage() );
        }
        

        
        return $statement;
    }



}




?>
