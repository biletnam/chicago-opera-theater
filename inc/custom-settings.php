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

 register_setting( 'general', 'cot_newsletter_url' );
 register_setting( 'general', 'cot_box_office_url' );
 register_setting( 'general', 'cot_donate_url' );
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

function get_cot_custom_settings() {
  $obj = array();
  $obj['donate_url'] = get_option('cot_donate_url');
  $obj['box_office_url'] = get_option('cot_box_office_url');
  $obj['newsletter_url'] = get_option('cot_newsletter_url');
  echo json_encode($obj, JSON_HEX_APOS);
}
