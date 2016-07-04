<?php
require_once __DIR__.'/usr/src/vendor/autoload.php';
require_once '/usr/src/vendor/google/apiclient/src/Google/autoload.php';

const CLIENT_ID = "1041743059665-67890t3u6eln3qiisn3o120j91qpncck.apps.googleusercontent.com"
const CLIENT_SECRET = "Eh76jxp7y-rXGBO-VzT1K-O9"
const REDIRECT_URI = "mind.supplies/me

session_start();
$client = nnew Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');

$plus = new Google_Service_Plus($client);

if(isset($_REQUEST['logout'])){
    session_unset();
}

if(isset($_GET['code'])){
    $client->authenticate($_GET['code']);
    $_SESSION["access_token'] = $client->getAccessToken();
    $redirect='http://'.$_server['HTTP_HOST'].$_SERVER['PHP_SELF'];
    header('Location:'.filter_var($redirect,FILTER_SANITIZE_URL));
}

if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
$me = $plus->people->get('me');
$id = $me['id'];
$name = $me['displayName'];
$email = $me['emails'][0]['value'];
$profile_image_url = $me['image']['url'];
$cover_image_url = $me['cover']['coverPhoto']['url'];
$profile_url = $me['url'];

}else{
$authUrl = $client->createAuthUrl();
}
?>
<?php
include 'index.html'?>
