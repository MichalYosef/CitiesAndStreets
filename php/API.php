
<?php


class API
{
    private $dbHandler;

    public function __construct( ){

        $this->TalkToClient();
    }
    
    private function TalkToClient()
    {
        
        if( isset($_POST['submit']) ) 
        {
           
            switch( $_POST['submit'])
            {
                case "AddNewStreet":
                {
                    $allCities = City::getAllCities();

                    if( $allCities != null ){
                        echo htmlBuilder::getInsertStreetHtml( $allCities );
                    }
                    break;
                }
                case "InsertNewStreet":
                {
                    if( ! $this->validateInputExist('streetName') )
                    {
                         App::log( "please enter street name!" );
                         return false;
                    }
                    else
                    {
                        if(isset( $_POST['cityId'] ) )
                        {
                            $newStreet = new Street($_POST['streetName'], $_POST['cityId']);
                            if(! $newStreet->insert() )
                            {
                                App:log("insert failed");
                                return false;
                            }
                        //    Notify::AlertSuccess( "insert Succeed" );
                            $this->showAll();
                            return true;
                                
                        }
                    }
                    break;
                }
                case "updtae":
                {
                    
                    break;
                }
                case "delete":
                {
                    
                    break;
                    

                }
                case "showAll":
                {
                     $this->ShowAll();
                      break;
                }
                default:
                {
                    Error::Alert( "Some error ocuured. couldnt find pressed button's name");
                    return false;
                }  
            }

            
        }

    }

    public function ShowAll(){
        
        $dbConnection = Connection::Instance();
        $stmt = $dbConnection->runSql("SELECT ls47_streets.id as street_id, ls47_streets.name as street_name, ls47_cities.id as city_id, ls47_cities.name as city_name FROM ls47_streets inner join ls47_cities on ls47_streets.c_id = ls47_cities.id");
                 
        if( ! $stmt )
        {
            return NULL;
        }

        
        if ($stmt->rowCount() > 0) {     

            while ($row = $stmt->fetch())
            {
                //street_id,  street_name,  city_id, city_name 
                echo 'street id: ' . $row["street_id"] . "<br>";
                echo 'street name: ' . $row["street_name"] . "<br>";
                echo 'city id: ' . $row["city_id"] . "<br>";
                echo 'city name: ' . $row["city_name"] . "<br><br><br>";
            }
            /*
            while ($row = $stmt->fetch())
            {
                //App::log("name: " . $row["name"] . " id: " .  $row["id"] );
                array_push( $allCities, new City( $row["name"],  $row["id"]) );
            }
            return $allCities;*/
            return true;
        }
        else {
            //App::log( "No data returned from db.</br>    static function getAllCities()");
            return NULL;
        }


    }

    private function validateInputExist( $inputName )
    {
        $valid = empty($_POST[ $inputName]) ;
        
        return !$valid;
    }


}




?>

