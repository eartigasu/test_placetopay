<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View;
use \Core\App;
use \App\Models\Payment;
use \App\Models\RestClient;



class PlaceToPay
{
    public function index()
    {
        View::set("title", "PlaceToPay");
        View::render("placetopay");
        
    }

    public function transaction()
    {
        $dataRequest = $this->getRequestParameters($_REQUEST);
        
        //echo ($dataEncode);
        $config = App::getConfig();

        $response = RestClient::placeToPay($config["p2p_session"], $dataRequest);

        $payment = new Payment();
        $payment->status = $response["status"]["status"];
        $payment->reason = $response["status"]["reason"];
        $payment->message = $response["status"]["message"];
        $payment->date = $response["status"]["date"];
        
        if($response["status"]["status"] == "OK"){
            $anotherURL = $response["processUrl"];
            $payment->requestId = $response["requestId"];
            $payment->processUrl = $response["processUrl"];
        }

        $payment->create();
        if($anotherURL)
            header("Location: ".$anotherURL."/".$dataRequest['payment']['reference']);
        else
            View::render("error");  

    }

    private function getRequestParameters($request){
        /** LOGICA CREACION AUTENTICACION**/
        //CREACION SEED
        $seed = date('c');
        // Creacion de NONCE
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $nonceBase64 = base64_encode($nonce);
        // CREACION TRANKEY
        $config = App::getConfig();
        $tranKey = base64_encode(sha1($nonce . $seed . $config["p2p_secretkey"], true));

        //reference
        $reference = $this->getGUIDnoHash();

        //Expiration
        $expiration = date('c', strtotime('+1 hour'));
        //returnURL
        $returnUrl = "http://localhost/p2p/public/home/index";

        //IP Cliente
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        //UserAgent
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $fileJson = file_get_contents($config["request_file"]);
        $jsonArray = json_decode ($fileJson, true);

        $jsonArray['auth']['login'] =  $config["p2p_identifier"];
        $jsonArray['auth']['seed'] = $seed;
        $jsonArray['auth']['nonce'] = $nonceBase64;
        $jsonArray['auth']['tranKey'] = $tranKey;

        $jsonArray['payment']['reference'] = $reference;
        $jsonArray['payment']['description'] = "Test Pago Sencillo";
        $jsonArray['payment']['amount']['currency'] = $request["currency"];
        $jsonArray['payment']['amount']['total'] = $request["amount"];

        $jsonArray['expiration'] = $expiration;
        $jsonArray['returnUrl'] = $returnUrl;
        $jsonArray['ipAddress'] = $ipAddress;
        $jsonArray['userAgent'] = $userAgent;

        return $jsonArray;
    }

    private function getGUIDnoHash(){
        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);

        return substr($c,0,14);
    }
}