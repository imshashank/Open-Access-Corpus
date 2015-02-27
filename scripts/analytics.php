<?php
function gen_uuid() { // Generates a UUID. A UUID is required for the measurement protocol.
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

$data = array( // This is an associative array that will contain all the parameters that we'll send to Google Analytics
'v' => 1, // The version of the measurement protocol
'tid' => $_REQUEST['UA-4441719-36'], // Google Analytics account ID (UA-98765432-1)
'cid' => gen_uuid(), // The UUID
't' => 'pageview' // Hit Type
);
?>
<?php
$data['dh'] = (isset($_REQUEST['domain']) ? $_REQUEST['domain'] : ""); 
// The domain of the site that is associated with the Google Analytics ID
$data['dl'] = (isset($_REQUEST['path']) ? $_REQUEST['path'] : ""); // The landing page
$data['dr'] = (isset($_SERVER['HTTP_REFERER'])); // The URL of the site that is sending the visit. Format: http%3A%2F%2Fexample.com
$data['ua'] =  $_SERVER['HTTP_USER_AGENT'];
$data['uip'] = $_SERVER['REMOTE_ADDR'];
$data['dp'] = (isset($_REQUEST['path']) ? $_REQUEST['path'] : ""); // The page that will receive the pageview
$data['dt'] = (isset($_REQUEST['page_title']) ? $_REQUEST['page_title'] : ""); // The title of the page that receives the pageview. In my case, this is a "virtual" page. So, I'm passing the title through the URL.
$data['cs'] = (isset($_REQUEST['utm_source']) ? $_REQUEST['utm_source'] : ""); // The source of the visit (e.g. google)
$data['cm'] = (isset($_REQUEST['utm_medium']) ? $_REQUEST['utm_medium'] : ""); // The medium (e.g. cpc)
$data['cn'] = (isset($_REQUEST['utm_campaign']) ? $_REQUEST['utm_campaign'] : ""); // The name of the campaign
$data['ck'] = (isset($_REQUEST['utm_term']) ? $_REQUEST['utm_term'] : ""); // The keyword that the user searched for
$data['cc'] = (isset($_REQUEST['utm_content']) ? $_REQUEST['utm_content'] : ""); // Used to differentiate ads or links that point to the same URL.
var_dump($data);
?>

<?php
$url = 'http://www.google-analytics.com/collect'; // This is the URL to which we'll be sending the post request.
$content = http_build_query($data); // The body of the post must include exactly 1 URI encoded payload and must be no longer than 8192 bytes. See http_build_query.
$content = utf8_encode($content); // The payload must be UTF-8 encoded.
$user_agent = 'TargetClickCallTracker/1.0 (http://targetclickmarketing.com/)'; 
?>

<?php

if (isset( $_SERVER['HTTP_USER_AGENT'])){
$user_agent = $_SERVER['HTTP_USER_AGENT'];
}
else $user_agent = 'Opera/9.80';

echo $content;
$ch = curl_init();
curl_setopt($ch,CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-type: application/x-www-form-urlencoded'));
curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
curl_setopt($ch,CURLOPT_POST, TRUE);
curl_setopt($ch,CURLOPT_POSTFIELDS, $content);
$output = curl_exec($ch);
curl_close($ch);

var_dump($output);
?>





