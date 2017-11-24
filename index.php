<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';


$fb = new Facebook\Facebook([
  'app_id' => '367170393708403',
  'app_secret' => '89777a0417c237199db7f950b99b29be ',
  'default_graph_version' => 'v2.11',
  // "persistent_data_handler"=>"session"
  ]);


$helper = $fb->getRedirectLoginHelper();
$permissions = ['']; // optional

$loginUrl = $helper->getLoginUrl('http://localhost/kmc/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>