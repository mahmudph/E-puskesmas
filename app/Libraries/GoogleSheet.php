<?php namespace App\Libraries;

use Google_Client;

class GoogleSheet extends Google_Client {
  public function __construct() {
    parent::__construct();
  }
}