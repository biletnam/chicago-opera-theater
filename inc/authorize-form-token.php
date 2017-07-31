<?php
  require get_template_directory() .  '/vendor/autoload.php';

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");

function createAnAcceptPaymentTransaction($params)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(get_option('cot_authorize_api_key'));
    $merchantAuthentication->setTransactionKey(get_option('cot_transaction_key'));

    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment object for a payment nonce
    $opaqueData = new AnetAPI\OpaqueDataType();
    $opaqueData->setDataDescriptor($params['dataDesc']);
    $opaqueData->setDataValue($params['dataValue']);


    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setOpaqueData($opaqueData);

    // Create order information
    $order = new AnetAPI\OrderType();
    $orderDetails = get_option('cot_current_subscriber_season') . ' SUBS: DATES ';
    foreach($params['details']['selected_dates'] as $date) {
      $orderDetails .= '['.$date.']';
    }
    $orderDetails .= ' QTY ['.$params['details']['number_of_seats'].'] ';
    $orderDetails .= 'SEC ['.$params['details']['zone'].'] ';
    $orderDetails .= 'DONATION [$'.$params['details']['donation_amount'].'] ';
    $orderDetails .= 'CCFEE [$'.$params['details']['fee'].'] ';
    $orderDetails .= 'TOTAL [$'.$params['total'].'] ';
    $orderDetails .= 'EMAIL ['.$params['customer']['email'].'] ';
    $order->setDescription($orderDetails);

    // Set the customer's Bill To address
    $cust = $params['customer']['billing'];
    $customerBillingAddress = new AnetAPI\CustomerAddressType();
    $customerBillingAddress->setFirstName($cust['first_name']);
    $customerBillingAddress->setLastName($cust['last_name']);
    $customerBillingAddress->setCompany($cust['company']);
    $customerBillingAddress->setPhoneNumber($params['customer']['phone']);
    $customerBillingAddress->setAddress($cust['address']);
    $customerBillingAddress->setCity($cust['city']);
    $customerBillingAddress->setState($cust['state']);
    $customerBillingAddress->setZip($cust['zip']);
    $customerBillingAddress->setCountry($cust['country']);

    // Set the customer's Bill To address
    $cust = $params['customer']['shipping'];
    $customerShippingAddress = new AnetAPI\NameAndAddressType();
    $customerShippingAddress->setFirstName($cust['first_name']);
    $customerShippingAddress->setLastName($cust['last_name']);
    $customerShippingAddress->setCompany($cust['company']);
    $customerShippingAddress->setAddress($cust['address']);
    $customerShippingAddress->setCity($cust['city']);
    $customerShippingAddress->setState($cust['state']);
    $customerShippingAddress->setZip($cust['zip']);
    $customerShippingAddress->setCountry($cust['country']);

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setEmail($params['customer']['email']);

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($params['total']);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerBillingAddress);
    $transactionRequestType->setShipTo($customerShippingAddress);
    $transactionRequestType->setCustomer($customerData);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    return $response;
}

function cot_post_payment_nonce(WP_REST_Request $request) {
  $params = $request->get_json_params();
  $response = createAnAcceptPaymentTransaction($params);
  $obj = array();
  if ($response != null) {
    $obj['result_code'] = $response->getMessages()->getResultCode();
    if ($response->getMessages()->getResultCode() == 'Ok') {
      $refId = $response->getRefId();
      $tresponse = $response->getTransactionResponse();

      if ($tresponse != null && $tresponse->getMessages() != null) {
        $obj['messages'] = array();
        foreach ($tresponse->getMessages() as $message) {
          $messageObj = array();
          $messageObj['text'] = $message->getDescription();
          $messageObj['code'] = $message->getCode();
          array_push($obj['messages'], $messageObj);
        }
        send_cot_subscription_notification($params, $refId);
      } else {
        if ($tresponse->getErrors() != null) {
          $obj['errors'] = array();
          foreach ($tresponse->getErrors() as $error) {
            $messageObj = array();
            $messageObj['text'] = $error->getErrorTest();
            $messageObj['code'] = $error->getErrorCode();
            array_push($obj['errors'], $messageObj);
          }
        }
      }
    } else {
      $tresponse = $response->getTransactionResponse();

      if ($tresponse != null && $tresponse->getErrors() != null) {
        $obj['errors'] = array();
        foreach ($tresponse->getErrors() as $error) {
          $messageObj = array();
          $messageObj['text'] = $error->getErrorCode();
          $messageObj['code'] = $error->getErrorText();
          array_push($obj['errors'], $messageObj);
        }
      }
    }
  }
  return $obj;
}

add_action('rest_api_init', function() {
  register_rest_route('cot', 'payment-post', array(
    'methods' => 'POST',
    'callback' => 'cot_post_payment_nonce'
  ));
});
