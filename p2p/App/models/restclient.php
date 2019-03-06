<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

require APPPATH . '/vendor/autoload.php';

use \Core\App;
use \GuzzleHttp\Client;

class RestClient
{	
	public static function placeToPay($api, $json){
        $config = App::getConfig();
        $jsonEncode = json_encode($json);

        $url = $config["p2p_endpoint"] . $api;
        
        $client = new Client([
            'base_uri' => $url,
            'verify' => false,
            'timeout'  => 5.0,
        ]);
        echo "CLIENTE: <br>";
        var_dump($client);
        

        $res = $client->request('POST', '' ,[
            'json' => $jsonEncode
        ]);

        if ($res->getStatusCode() == '200') //Verifico que me retorne 200 = OK
        {
            echo "codigo: [ ".$res->getStatusCode() ." ]";
            $jsonResponse = json_decode($res->getBody(), true);
            echo "respuesta: [".$jsonResponse ."]";
        }
        else{
            echo "codigo: [ ".$res->getStatusCode() ." ]";
            $jsonResponse = json_decode($res->getBody(), true);
            echo "respuesta: [".$jsonResponse ."]";
        }

        return $jsonResponse;

    }

    
}
?>