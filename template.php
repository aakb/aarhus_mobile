<?php

function aarhus_mobile_preprocess_page(&$vars) {
  global $theme;
  global $theme_path;
  
  // Don't display empty help from node_help().
  if ($vars['help'] == "<div class=\"help\"> \n</div>") {
    $vars['help'] = '';
  }

  // Set variables for the logo and site_name.
  if (isset($vars['logo'])) {
    // Return the site_name even when site_name is disabled in theme settings.
    $vars['logo_alt_text'] = (!isset($vars['logo_alt_text']) ? variable_get('site_name', '') : $vars['logo_alt_text']);
    $vars['site_logo'] = '<a class="site-logo" href="'. $vars['front_page'] .'" title="'. t('Home page') .'" rel="home"><img src="'. $vars['logo'] .'" alt="'. $vars['logo_alt_text'] .'" /></a>';
  }   

}

/**
 * Implementation of hook_theme.
 */
function aarhus_mobile_theme() {
  return array(
    'user_login' => array(
      'template' => 'user-login',
      'arguments' => array('form' => NULL),
    ),
    'ting_search_form' => array(
      'arguments' => array('form' => NULL),
    ),
  );
}


/**
 * Theme function that can be used to remove stuff form the search form. The
 * h2 headline can be disabled on the block for current theme.
 */
function aarhus_mobile_ting_search_form(&$form){
  global $theme_path;
  
  unset($form['example_text']);
  // $form['submit']['#type'] = 'image_button';
  // $form['submit']['#src'] = $theme_path .'/images/button-search.png'; 
  return drupal_render($form);
}