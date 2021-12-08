<?php
$characters = array(
    array( "name" => "Peter Parker", "email" => "peterparker@mail.com", ),
    array( "name" => "Clark Kent", "email" => "clarkkent@mail.com", ),
    array( "name" => "Harry Potter", "email" => "harrypotter@mail.com", )
);
array_push($characters, array("name" => "Zeus", "email" => "zeus@olympus.com", ));
array_push($characters, array("name" => "Tony Stark", "email" => "ironman@avengers.com", ));

echo "<pre>";
print_r($characters);
function array_to_xml( $data, &$xml_data ) {
    foreach( $data as $key => $value ) {
        if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; //dealing with <0/>..<n/> issues
            }
            $next = $xml_data->addChild($key);
            array_to_xml($value, $next);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
    }
}

$xmlfile = new SimpleXMLElement('<character/>');

array_to_xml($characters,$xmlfile);

$xmlfile->asXML('characters.xml');

// this is second feature
?>