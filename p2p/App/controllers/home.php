<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View;
use \App\Models\Payment;

class Home
{


    public function index(){
		$payments = new Payment();
		$listPayments = array();
		$result = $payments->read();

		View::set("payments", $result);
    	View::set("title", "List PlaceToPay");
    	View::render("home");
    }
}