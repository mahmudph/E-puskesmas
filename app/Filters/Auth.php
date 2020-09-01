<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class Auth implements FilterInterface {
  protected $session;
  public function __construct() {
    $this->session = session();
  }

  public function before(RequestInterface $request, $arguments=NULL) {
    $isLogin =  $this->session->has('is_login');
    if(!$isLogin) {
      $v['inputs']['email'] = '';
      $v['inputs']['password'] = '';
      $v['errors'] = ['Silahkan login terlebih dahulu'];
      $this->session->setFlashdata('response',$v);
      return redirect()->to(site_url('auth/login'));
    } 
  }
  public function after(RequestInterface $request, ResponseInterface $response, $arguments=NULL) {
    /* pass */
  }
}

?>