<?php
function custom_cot_settings_init() {
 add_settings_section(
   'cot_custom_settings_section',
   'General Sidebar Settings',
   'cot_custom_settings_section_callback_function',
   'general'
 );

 add_settings_field(
   'cot_newsletter_url',
   'Newsletter Subscription URL',
   'cot_newsletter_url_callback_function',
   'general',
   'cot_custom_settings_section'
 );

 add_settings_field(
   'cot_box_office_url',
   'Box Office URL',
   'cot_box_office_url_callback_function',
   'general',
   'cot_custom_settings_section'
 );

 add_settings_field(
   'cot_donate_url',
   'Newsletter Subscription URL',
   'cot_donate_url_callback_function',
   'general',
   'cot_custom_settings_section'
 );

 add_settings_section(
   'cot_custom_authorize_settings_section',
   'Authorize.net Settings',
   'cot_custom_authorize_settings_section_callback_function',
   'general'
 );

 add_settings_field(
   'cot_authorize_testing',
   'Use Authorize in Sandbox Mode',
   'cot_authorize_testing_callback_function',
   'general',
   'cot_custom_authorize_settings_section'
 );

 add_settings_field(
   'cot_authorize_api_key',
   'Authorize.net API Login ID',
   'cot_authorize_api_key_callback_function',
   'general',
   'cot_custom_authorize_settings_section'
 );

 add_settings_field(
   'cot_transaction_key',
   'Authorize.net Transaction Key',
   'cot_transaction_key_callback_function',
   'general',
   'cot_custom_authorize_settings_section'
 );

 add_settings_field(
   'cot_client_key',
   'Authorize.net Client Key',
   'cot_client_key_callback_function',
   'general',
   'cot_custom_authorize_settings_section'
 );

 register_setting( 'general', 'cot_newsletter_url' );
 register_setting( 'general', 'cot_box_office_url' );
 register_setting( 'general', 'cot_donate_url' );
 register_setting( 'general', 'cot_authorize_testing' );
 register_setting( 'general', 'cot_authorize_api_key' );
 register_setting( 'general', 'cot_transaction_key' );
 register_setting( 'general', 'cot_client_key' );
}

add_action( 'admin_init', 'custom_cot_settings_init' );

function cot_custom_settings_section_callback_function() {
 echo '<p>Here you can set the urls for the side bar on each page</p>';
}

function cot_newsletter_url_callback_function() {
 echo '<input name="cot_newsletter_url" id="cot_newsletter_url" class="code" value="'.get_option('cot_newsletter_url').'" /> Set the link for the newsletter subscription';
}

function cot_box_office_url_callback_function() {
 echo '<input name="cot_box_office_url" id="cot_box_office_url" class="code" value="'.get_option('cot_box_office_url').'" /> Set the link for the box office page';
}

function cot_donate_url_callback_function() {
 echo '<input name="cot_donate_url" id="cot_donate_url" class="code" value="'.get_option('cot_donate_url').'" /> Set the link for the donate page';
}

function cot_custom_authorize_settings_section_callback_function() {
  echo '<p>Here you can set the details for Authorize.net</p>';
}

function cot_authorize_testing_callback_function() {
 echo '<input type="checkbox" id="cot_authorize_testing" name="cot_authorize_testing" value="1"' . checked( 1, get_option('cot_authorize_testing'), false ) . '/>';
}

function cot_authorize_api_key_callback_function() {
 echo '<input name="cot_authorize_api_key" id="cot_authorize_api_key" class="code" value="'.get_option('cot_authorize_api_key').'" />';
}

function cot_transaction_key_callback_function() {
 echo '<input name="cot_transaction_key" id="cot_transaction_key" class="code" value="'.get_option('cot_transaction_key').'" />';
}

function cot_client_key_callback_function() {
 echo '<input name="cot_client_key" id="cot_client_key" class="code" value="'.get_option('cot_client_key').'" />';
}

function get_cot_custom_settings() {
  $obj = array();
  $obj['donate_url'] = get_option('cot_donate_url');
  $obj['box_office_url'] = get_option('cot_box_office_url');
  $obj['newsletter_url'] = get_option('cot_newsletter_url');
  echo json_encode($obj, JSON_HEX_APOS);
}

function get_cot_authorize_custom_settings() {
  $obj = array();
  $obj['api_key'] = get_option('cot_authorize_api_key');
  $obj['client_key'] = get_option('cot_client_key');
  return $obj;
}
