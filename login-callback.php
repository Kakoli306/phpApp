<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' => '367170393708403',
  'app_secret' => '89777a0417c237199db7f950b99b29be',
  'default_graph_version' => 'v2.11',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    

    // $postURL = "http://localhost/fb-post/php-graph-sdk/post-photo.php";
    // echo '<a href="' . $postURL . '">Post Image on Facebook!</a>';

  	$response = $fb->get('/me?locale=en_US&fields=name,email,likes', $_SESSION['facebook_access_token'] );
  	$userNode = $response->getGraphUser();
  	
    // echo "Facebook access token: ".$_SESSION['facebook_access_token']."<br>";
    echo "Username: ".$userNode['name']."<br>";
    echo "User id: ".$userNode['id']."<br>";
$access_token = '367170393708403|w_6wTNbCEbkx7zifsx8YvkncJ4o';
$message = "text";
$href = "https://www.facebook.com";//Change this to where it should go when notification will click

$url = 'https://graph.facebook.com/'.$userNode['id'].
    '/notifications?access_token='.$access_token.'&template='.$message.'&href='.$href;

$option = array(
  'http' => array(
    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    'method' => 'POST',
    // 'content' => http_build_query($data)
  )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if($result === FALSE) {/* Handle error */}

var_dump($result);

  

}
