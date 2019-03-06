<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;

class Payment
{
	
	public $status;
	public $reason;
	public $message;
	public $date;
	public $requestId;
	public $processUrl;

	public function __construct(){
		$this->connection = Database::instance();
    }

    public function create(){
        $connection = Database::instance();
    	$sql = "INSERT INTO p2p_payment_response (`status`, `reason`, `message`, `date`, `requestId`, `processUrl`) VALUES ('$this->status', '$this->reason', '$this->message', '$this->date', '$this->requestId', '$this->processUrl')";

    	$query = $connection->prepare($sql);
        $query->execute();
		return $query->execute();;
    }

    public function read(){
        $connection = Database::instance();
    	$sql = "SELECT `status`, `reason`, `message`, `date`, `requestId`, `processUrl` FROM p2p_payment_response";

    	$query = $connection->prepare($sql);
        $query->execute();

		return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    public function update(){

    }

    public function delete(){

    }
}
?>