<?php

// Generate UUID v4 function - needed to generate a CID when one isnt available
function gaGenUUID() {
  return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

    // 16 bits for "time_mid"
    mt_rand( 0, 0xffff ),

    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand( 0, 0x0fff ) | 0x4000,

    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand( 0, 0x3fff ) | 0x8000,

    // 48 bits for "node"
    mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
  );
}

// Handle the parsing of the _ga cookie or setting it to a unique identifier
function gaParseCookie() {
  if (isset($_COOKIE['_ga'])) {
    list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
    $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
    $cid = $contents['cid'];
  }
  else $cid = gaGenUUID();
  return $cid;
}

function gaBuildHit( $method = null, $info = null ) {
  if ( $method && $info) {

  // Standard params
  $v = 1;
  $tid = "UA-4441719-36"; // Put your own Analytics ID in here
  $cid = gaParseCookie();


  $user_agent = ($_SERVER['HTTP_USER_AGENT']);
  $remote = ($_SERVER['REMOTE_ADDR']);

  // Register a PAGEVIEW
  if ($method === 'pageview') {

    // Send PageView hit
    $data = array(
      'v' => $v,
      'tid' => $tid,
      'cid' => $cid,
      'dh' =>'api.open-academia.org',
      't' => 'pageview',
      'dt' => $info['title'],
      'dp' => $info['slug'],
      'ua' => $user_agent,
      'uip' =>$remote,

    );

    gaFireHit($data);

  } // end pageview method


 }
}

// See https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide
function gaFireHit( $data = null ) {
  if ( $data ) {
    //$getString = 'https://ssl.google-analytics.com/collect';
    $getString = '?payload_data&';
    $getString .= http_build_query($data);
    //var_dump($getString);
    $result = $getString;

    #$sendlog = error_log($getString, 1, "ME@EMAIL.COM"); // comment this in and change your email to get an log sent to your email
$url = 'https://ssl.google-analytics.com/collect';

if (isset( $_SERVER['HTTP_USER_AGENT'])){
$user_agent = $_SERVER['HTTP_USER_AGENT'];
}
else $user_agent = 'Opera/9.80';
$ch = curl_init();
curl_setopt($ch,CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
curl_setopt($ch,CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $getString);
$result = curl_exec($ch);
curl_close($ch);
//    return $result;
  }
 // return false;
}


/*
$data = array(
  'title' => 'Open Access Academia',
  'slug' => '/request'
);
gaBuildHit( 'pageview', $data);
*/

?>