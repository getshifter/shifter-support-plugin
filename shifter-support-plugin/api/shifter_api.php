<?php

class Shifter {
  private $site_id = '';
  private $generate_url = '';
  private $terminate_url = '';
  private $access_token = '';
  private $refresh_token = '';

  public function __construct() {
    $this->site_id = getenv("SITE_ID");
    $this->access_token = getenv('SHIFTER_ACCESS_TOKEN');
    $this->refresh_token = getenv('SHIFTER_REFRESH_TOKEN');
    $this->terminate_url = "https://37r4p3mq51.execute-api.us-east-1.amazonaws.com/development/v2/projects/$this->site_id/wordpress_site/stop";
    $this->generate_url = "https://wxx4qap.api.goshifter.co/v1/projects/$this->site_id/artifacts";
    $this->refresh_url = "https://wxx4qap.api.goshifter.co/v1/login";
    #$terminate_url = "https://kelbes0rsk.execute-api.us-east-1.amazonaws.com/production/v2/projects/${site_id}/wordpress_site/stop";
    #$generate_url = "https://api.getshifter.io/v1/artifacts/${site_id}";
  }

  public function terminate_wp_app() {
    $r = wp_remote_request($this->terminate_url, $this->build_args());
    if($r[response][code] != 200) {
      $this->refresh_token();
      $r = wp_remote_request($this->terminate_url, $this->build_args());
    }
    return $r[response][code];
  }

  public function generate_wp_app() {
    $r = wp_remote_request($this->generate_url, $this->build_args());
    if($r[response][code] != 201) {
      $this->refresh_token();
      $r = wp_remote_request($this->generate_url, $this->build_args());
    }
    return $r[response][code];
  }

  private function build_args() {
    $headers = array(
      'authorization' => $this->access_token,
      'content-Type' => 'application/json'
    );
    return array('method' => 'POST', 'headers' => $headers);
  }

  private function refresh_token() {
    $headers = array('content-type' => 'application/json');
    $args = array(
      'method' => 'PUT',
      'headers' => $headers,
      'body' => json_encode(array('refreshToken' => $this->refresh_token))
    );
    $response = wp_remote_request($this->refresh_url, $args);
	  $body = $response[body];
	  $body_array = json_decode($body);
	  $this->access_token = $body_array->AccessToken;
	  putenv("SHIFTER_ACCESS_TOKEN=$this->access_token");
  }
}

?>
