<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AutorizationDinas implements FilterInterface {
  protected $session;
  public function __construct() {
    $this->session = \Config\Services::session();
  }

  public function before(RequestInterface $request, $arguments=NULL) {
    $usr_level =  $this->session->get('user_level');
    if($usr_level != 1) {
      echo view('errors/html/production.php');
    }
  }
  public function after(RequestInterface $request, ResponseInterface $response, $arguments=NULL) {
    /* pass */
  }
}



?>