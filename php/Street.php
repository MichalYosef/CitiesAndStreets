<?php

class Street{
    private $id;
    private $name;
    private $c_id;

    public function __construct( $name, $c_id, $id=0){

        $this->name = $name;
        $this->c_id = $c_id;
        $this->id = $id;

    }

    public function get(){
        
    }

    public function insert( )
    {
        $con = Connection::Instance();
        
        return   $con->runSql('INSERT INTO ls47_streets( name, c_id) VALUES( :name, :c_id)',
                               array( "name" => $this->name,
                                      "c_id" => $this->c_id));
        
        
    } 


}




?>