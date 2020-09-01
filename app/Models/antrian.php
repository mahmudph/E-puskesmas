<?php namespace App\Models;

use Codeigniter\Model;

class UserModel extends Model {
  protected $table = 'tbl_antrians';
  // protected $validationRules = [
  //   'nama' => 'required',
  //   'email' => 'required|valid_email',
  //   'jenis_kelamin' => 'required',
  //   'tgl_lahir' => 'required',
  //   'alamat' => 'required',
  //   'user_level' => 'required',
  //   'password' => 'required|min_length[10]'
  // ];

  // protected $validationMessages = [
  //   'nama' => 'atribut nama tidak boleh kosong',
  //   'email' => 'email anda tidak valid',
  //   'jenis_kelamin' => 'pilih salah satu jenis kelamin',
  //   'tgl_lahir' => 'tanggal lahir tidak boleh kosong',
  //   'alamat' => 'alamat tidak boleh kosong',
  //   'user_level' => 'pilih user level',
  //   'password' => ''
  // ];

  public function find_by_email_pwd($email, $password) {
    $where  = ['email' => $email,'password' => $password];
    $result = $this->db->getWhere($where)->result();
    return $result;
  }

  public function insertData($data) {
    $this->db->insert($data);
  }

  public function deleteByid($id) {
    $this->db->delete(['id' => $id]);
  }

  public function updateById($data, $id) {
    return $this->db->update($data. ['id' => $id]);
  }
}


?>