<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
							'type'           => 'INT',
							'constraint'     => 6,
							'auto_increment' => true,
			],
			'nama'   => [
							'type'           => 'VARCHAR',
							'constraint'     => '50',
			],
			'email' => [
							'type' => 'VARCHAR',
							'constraint'     => '20',
							'null' => false,
			],
			'jenis_kelamin' => [
							'type'           => 'CHAR',
							'null'           => false,
			],
			'tgl_lahir' => [
							'type'           => 'DATETIME',
							'null'           => false,
							"constraint"    => 6,
			],
			'desa' => [
				'type' => 'VARCHAR',
				'constraint'     => '50',
				'null' => false,
			],
			'alamat' 	=> [
							'type'           => 'TEXT',
							'null'           => false,
			],
			'user_level' => [
				'type'           => 'int',
				'null'           => false,
				"constraint"    => 1,
				"default" => 3,
			],
			'password' => [
				'type'           => 'varchar',
				'null'           => false,
				"constraint"    => 50,
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_users');
	}
}
