<?php namespace App\Libraries;

class Email {
  public function __construct(){
    $this->config = [];
    $this->user_from = [
      'nama' => getenv('app.email.nama'),
      'email'=> getenv('app.email.url'),
      'pwd'  => getenv('app.email.pwd'),
    ];
    $this->email  = \Config\Services::email();
  }

  public function configure() {
    $this->config['protocol'] = 'sendmail';
    $this->config['mailPath'] = '/usr/sbin/sendmail';
    $this->config['charset']  = 'iso-8859-1';
    $this->config['wordWrap'] = true;
    $this->email->initialize($this->config);
  }

  public function iniliailize(string $to, string $object, string $msg) {
    $this->email->setFrom($this->user_from['email'], $this->user_from['nama']);
    $this->email->setTo($to);
    $this->email->setSubject($object);
    $this->email->setMessage($msg);
  }

  public function sendEmail(string $email) {
    $this->email->send();
  }

}

?>