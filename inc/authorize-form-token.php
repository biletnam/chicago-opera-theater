<?php
require get_template_directory() .  '/vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

function getAnAcceptPaymentPage($params)
{
  /* Create a merchantAuthenticationType object with authentication details
     retrieved from the constants file */
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName('987f2bGPK');
  $merchantAuthentication->setTransactionKey('4J4fcmf44G2E8Z9q');

  // Set the transaction's refId
  $refId = 'ref' . time();

  //create a transaction
  $transactionRequestType = new AnetAPI\TransactionRequestType();
  $transactionRequestType->setTransactionType("authCaptureTransaction");
  $transactionRequestType->setAmount('12.00');

  $customerDataType = new AnetAPI\CustomerDataType();
  $customerDataType->setEmail('joshua.r.bartlett@gmail.com');

  $transactionRequestType->setCustomer($customerDataType);

  $customerAddressType = new AnetAPI\CustomerAddressType();
  $customerAddressType->setFirstName($params['customer']['billing']['first_name']);
  $customerAddressType->setLastName($params['customer']['billing']['last_name']);
  $customerAddressType->setPhoneNumber($params['customer']['phone']);
  $customerAddressType->setCompany($params['customer']['billing']['company']);
  $customerAddressType->setAddress($params['customer']['billing']['address']);
  $customerAddressType->setCity($params['customer']['billing']['city']);
  $customerAddressType->setState($params['customer']['billing']['state']);
  $customerAddressType->setZip($params['customer']['billing']['zip']);
  $customerAddressType->setCountry($params['customer']['billing']['country']);

  $transactionRequestType->setBillTo($customerAddressType);

  // Set Hosted Form options
  $setting1 = new AnetAPI\SettingType();
  $setting1->setSettingName("hostedPaymentButtonOptions");
  $setting1->setSettingValue("{\"text\": \"Pay\"}");

  $setting2 = new AnetAPI\SettingType();
  $setting2->setSettingName("hostedPaymentOrderOptions");
  $setting2->setSettingValue("{\"show\": false}");

  $setting3 = new AnetAPI\SettingType();
  $setting3->setSettingName("hostedPaymentReturnOptions");
  $setting3->setSettingValue("{\"showReceipt\": true}");

  $setting4 = new AnetAPI\SettingType();
  $setting4->setSettingName("hostedPaymentShippingAddressOptions");
  $setting4->setSettingValue("{\"show\": false}");

  $setting5 = new AnetAPI\SettingType();
  $setting5->setSettingName("hostedPaymentBillingAddressOptions");
  $setting5->setSettingValue("{\"show\": false}");

  $setting6 = new AnetAPI\SettingType();
  $setting6->setSettingName("hostedPaymentIFrameCommunicatorUrl");
  $setting6->setSettingValue("{\"url\": \"https://www.chicagooperatheater-staging.com\"}");

  // Build transaction request
  $request = new AnetAPI\GetHostedPaymentPageRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setTransactionRequest($transactionRequestType);

  $request->addToHostedPaymentSettings($setting1);
  $request->addToHostedPaymentSettings($setting2);
  $request->addToHostedPaymentSettings($setting3);
  $request->addToHostedPaymentSettings($setting4);
  $request->addToHostedPaymentSettings($setting5);
  $request->addToHostedPaymentSettings($setting6);

  //execute request
  $controller = new AnetController\GetHostedPaymentPageController($request);
  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

  return $response;
}

function serialize_cot_form_token(WP_REST_Request $request) {
  $params = $request->get_json_params();
  $response = getAnAcceptPaymentPage($params);
  $obj['token'] = $response->getToken();
  $obj['result_code'] = $response->getMessages()->getResultCode();
  $obj['messages'] = array();
  foreach ($response->getMessages()->getMessage() as $message) {
    $messageObj = array();
    $messageObj['text'] = $message->getText();
    $messageObj['code'] = $message->getCode();
    array_push($obj['messages'], $messageObj);
  }
  return $obj;
}

add_action('rest_api_init', function() {
  register_rest_route('cot', 'form-token', array(
    'methods' => 'POST',
    'callback' => 'serialize_cot_form_token'
  ));
});
