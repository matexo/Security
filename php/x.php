<?php
function getBrowserFingerprint() {
    #$client_ip = getClientIp();
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $accept   = $_SERVER['HTTP_ACCEPT'];
    #$charset  = $_SERVER['HTTP_ACCEPT_CHARSET'];
    $encoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
    $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $data = '';
    #$data .= $client_ip;
    #$data .= '</br>';
    $data .= $useragent;
    $data .= '</br>';
    $data .= $accept;
    $data .= '</br>';
    #$data .= $charset;
    #$data .= '</br>';
    $data .= $encoding;
    $data .= '</br>';
    $data .= $language;
    #$data .= '</br>';
    return $data;
}

function getClientIp() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
        }
      }
   }
  }
}







echo getBrowserFingerprint();
?>