<?php

class htmlBuilder
{
    static function getInsertStreetHtml( $allCities)
    {
        
        
        $htmlStr = '<label for="cityId">Choose City for new street:</label>
                    <select class="form-control" name="cityId">';

                    for( $i=0 ; $i < count( $allCities ) ; $i++ )
                    {
                    
                        $htmlStr .= '<option value="' . strval( $allCities[$i]->getId() ) . '">' . $allCities[$i]->getName() . '</option>';
                    }

        $htmlStr .= '</select>';
        
        
        return htmlBuilder::wrapHtmlBootsrtap( htmlBuilder::wrapHtmlVerticalForm( $htmlStr, "main.php", "Insert new street" ) );
        
    }

    

    static function wrapHtmlBootsrtap( $innerHtmlString ){

        $wholeHtmlString = '<!DOCTYPE html>
                            <html>
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                                </head>
                                <body>' .
                                    $innerHtmlString . 
                                    '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                </body>
                            </html>';

        return $wholeHtmlString;                    
    }

    static function wrapHtmlVerticalForm( $innerHtmlString, $actionPageSrc, $Title="" ){

        $formHtmlString = '<div class="container">
                                <h2>'. $Title .'</h2>
                                <form action="'.$actionPageSrc.'" method="POST" class="center-block">
                                    <div class="form-group">' .
                                        $innerHtmlString .
                                    '</div>
                                    <div class="form-group">
                                        <label for="streetName">Street name:</label>
                                        <input type="text" class="form-control" id="swName" placeholder="Enter new software name" name="streetName">
                                    </div>
                                    
                                    <button  name="submit" value="InsertNewStreet"  class="center-block btn btn-primary navbar-btn btn-rounded"> Insert! </button>
                                </form>
                            </div>';
                                    
        return $formHtmlString;                    
    }


    
}
?>