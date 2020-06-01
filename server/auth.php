<?php
// Okta authentication

session_start();

// Allows users to access editing functions
$user_loggedin = false;



function http($url, $params=false) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if($params)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
  return json_decode(curl_exec($ch));
}

if(isset($_GET['logout'])) {
  unset($_SESSION['username']);
  header('Location: /');
  die();
}

if(isset($_SESSION['username'])) {
  $auth_btn = '<a class="nav-link" href="/?logout">Log Out</a>';
  $user_loggedin = true;
}

// Configuration
$client_id = '0oac2v2ebIMFdrk604x6';
$client_secret = 'f6jr9jd6RrLvY9olBq-gVwtgmcy2A3mIHHAdexXS';
$redirect_uri = 'http://localhost:4000';
$metadata_url = 'https://dev-772697.okta.com/oauth2/auscaxyg6lnaitKCU4x6/.well-known/oauth-authorization-server';
$metadata = http($metadata_url);


if(isset($_GET['code'])) {

  if($_SESSION['state'] != $_GET['state']) {
    die('Authorization server returned an invalid state parameter');
  }

  if(isset($_GET['error'])) {
    die('Authorization server returned an error: '.htmlspecialchars($_GET['error']));
  }

  $response = http($metadata->token_endpoint, [
    'grant_type' => 'authorization_code',
    'code' => $_GET['code'],
    'redirect_uri' => $redirect_uri,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
  ]);

  if(!isset($response->access_token)) {
    die('Error fetching access token');
  }

  $token = http($metadata->introspection_endpoint, [
    'token' => $response->access_token,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
  ]);

  if($token->active == 1) {
    $_SESSION['username'] = $token->username;
    header('Location: /');
    die();
  }
}

if(!isset($_SESSION['username'])) {
  $_SESSION['state'] = bin2hex(random_bytes(5));

  $authorize_url = $metadata->authorization_endpoint.'?'.http_build_query([
    'response_type' => 'code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'state' => $_SESSION['state'],
    'scope' => 'openid',
  ]);
  #$authorize_url = 'TODO';

  $auth_btn = '<a class="nav-link" href="'.$authorize_url.'">Log In</a>';
}
