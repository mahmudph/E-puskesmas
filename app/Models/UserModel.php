<?php namespace App\Models;

use CodeIgniter\Model;


class UserModel extends Model {
  protected $table = 'tbl_user';
  protected $allowedFields = ['nama', 'email', 'jenis_kelamin', 'tgl_lahir', 'alamat', 'user_level', 'password'];
  public function find_by_email_pwd($email, $password) {
    $where  = ['email' => $email,'password' => $password];
    $result = $this->table('tbl_user')->where($where)->get()->getRow();
    return $result;
  }
  public function deleteByid($id) {
    $this->db->delete(['id' => $id]);
  }

  public function updateById($data, $id) {
    return $this->db->update($data. ['id' => $id]);
  }
}


?>