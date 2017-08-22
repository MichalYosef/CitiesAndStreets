<?php

class City{
    private $id;
    private $name;
    private $tblName;

    public function __construct( $name, $id){

        $this->id = $id;
        $this->name = $name;
        //$this->tblName = ls47_cities;

    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    static function getAllCities(  )
    {
        $dbConnection = Connection::Instance();
        $stmt = $dbConnection->runSql( "SELECT * FROM ls47_cities" );
        if( ! $stmt )
        {
            return NULL;
        }

        $allCities =[];

        if ($stmt->rowCount() > 0) {     
            while ($row = $stmt->fetch())
            {
                
                array_push( $allCities, new City( $row["name"],  $row["id"]) );
            }
            return $allCities;
        }
        else {
            
            return NULL;
        }

    }

    


}




?>