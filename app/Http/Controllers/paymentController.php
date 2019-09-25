<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
class paymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct(){

    	$this->clientId=config('paypal.sandbox_client_id');
    	$this->secret=config('paypal.sandbox_secret');
    	$this->apiContext = new ApiContext( new OAuthTokenCredential($this->clientId,$this->secret));
    	$this->apiContext->setConfig(config('paypal.settings'));
    }

    public function paywithpaypal(Request $request){

    	$price = $request->input('price');
    	$name = $request->input('name');
    	
    	$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$item = new Item();
		$item->setName($name)
    	->setCurrency('USD')
    	->setQuantity(1)
    	->setDescription("There is item description")
    	->setPrice($price);

    	$itemList = new ItemList();
		$itemList->setItems([$item]);

		$amount = new Amount();
		$amount->setCurrency("USD")
    	->setTotal($price);
    	
    	$transaction = new Transaction();
		$transaction->setAmount($amount)
    	->setItemList($itemList)
    	->setDescription("Bying something from my site")
    	->setInvoiceNumber(uniqid());

    	$redirectUrls = new RedirectUrls();
    	$redirectUrls->setReturnUrl('http://127.0.0.1:8000/payment/status')
    	->setCancelUrl('http://127.0.0.1:8000/payment/canceled');


    	$payment = new Payment();
		$payment->setIntent("sale")
    	->setPayer($payer)
   		->setRedirectUrls($redirectUrls)
    	->setTransactions(array($transaction));
    	
    	try {
    		$payment->create($this->apiContext);
    	} catch (\PayPal\Exception\PPConnectionException $e) {
    				die($e)	;
    	}

    	$paymentLink = $payment->getApprovalLink();
    	return redirect($paymentLink);
    	}
    	public function status(Request $request){
    		if (empty($request->input('PayerID')) || empty($request->input('token'))) {
    			die('payment failed');
    		}


    		$paymentid = $request->get('paymentId');
    		$payment = Payment::get($paymentid,$this->apiContext);
    		$execution = new PaymentExecution();
    		$execution->setPayerId($request->input('PayerID'));
    		$result = $payment->execute($execution,$this->apiContext);
    		if ($request->getState()=='approved') {
    			die('Thank you , payment success');
    		}

    		echo "payment failed again";
    		die($result);
    	}

    	public function canceled(){
    		return 'payment cancelrd , dont worry';

    		
    	}
    
}
