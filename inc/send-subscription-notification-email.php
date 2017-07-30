<?php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
function send_cot_subscription_notification($params, $refID) {
  $toAddress = get_option('cot_transaction_email');
  $subject = 'SEASON SUBSCRIBER ' . get_option('cot_current_subscriber_season') . ' - ' . $refID;
  $message = 'Seat quantity: ' . $params['details']['number_of_seats'] . "\n";
  $message .= 'Price Zone: ' . $params['details']['zone'] . "\n";
  $message .= 'Special Requests: ' . $params['details']['request'] . "\n";
  $message .= "\n";
  $message .= "==========================================\n";
  $message .= "\n";
  $message .= "Chosen dates:\n";
  foreach($params['details']['selected_dates'] as $date) {
    $message .= "    $date \n";
  }
  $message .= "\n";
  $message .= "==========================================\n";
  $message .= "\n";
  $message .= 'Subtotal: $' . $params['details']['subtotal'] . "\n";
  $message .= 'Donation: $' . $params['details']['donation_amount'] . "\n";
  $message .= 'Handling Fee: $' . $params['details']['fee'] . "\n";
  $message .= 'Total: $' . $params['total'] . "\n";
  $message .= "\n";
  $message .= "==========================================\n";
  $message .= "\n";
  $message .= 'Subscription holder: ' . $params['customer']['subscriber_salutation'] . ' ' . $params['customer']['subscriber_name'] . "\n";
  $message .= 'Billing Name: ' . $params['customer']['billing']['first_name'] . ' ' . $params['customer']['billing']['last_name'] . "\n";
  $message .= 'Heard About From: ' . $params['details']['hear_about'] . "\n";
  $message .= 'Phone: ' . $params['customer']['phone'] . "\n";
  $message .= 'Email: ' . $params['customer']['email'] . "\n";
  $message .= 'Company: ' . $params['customer']['billing']['company'] . "\n";
  $message .= 'Address: ' . $params['customer']['billing']['address'] . "\n";
  $message .= 'Address Cont.: ' . $params['customer']['billing']['address_2'] . "\n";
  $message .= 'City, State, Zip, Country: ' . $params['customer']['billing']['city'] . ', ' . $params['customer']['billing']['state'] . ', ' . $params['customer']['billing']['zip'] . ', ' . $params['customer']['billing']['country'] . "\n";
  $message .= "\n";
  $message .= "==========================================\n";
  $message .= "\n";
  $message .= 'Shipping Name: ' . $params['customer']['shipping']['first_name'] . ' ' . $params['customer']['shipping']['last_name'] . "\n";
  $message .= 'Company: ' . $params['customer']['shipping']['company'] . "\n";
  $message .= 'Address: ' . $params['customer']['shipping']['address'] . "\n";
  $message .= 'Address Cont.: ' . $params['customer']['shipping']['address_2'] . "\n";
  $message .= 'City, State, Zip, Country: ' . $params['customer']['shipping']['city'] . ', ' . $params['customer']['shipping']['state'] . ', ' . $params['customer']['shipping']['zip'] . ', ' . $params['customer']['shipping']['country'] . "\n";

  wp_mail($toAddress, $subject, $message);
}
