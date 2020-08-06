<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPendaftaran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'int',
				'constraint' => 6, 
				'auto_increment' => true,
				'null' => false,
			],
			'id_user' => [
				'type' => 'int',
				'constraint' => 6,
				'null' => false
			], 
			'id_puskesmas' => [
				'type' => 'int',
				'constraint' => 6,
				'null' => false
			],
			'tgl_daftar' => [
				'type' => 'datetime',
				'constraint' => 6,
				'null' => false
			],

			'tgl_digunakan' => [
				'type' => 'datetime',
				'constraint' => 6,
				'null' => false
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_user', 'tbl_user', 'id');
		$this->forge->addForeignKey('id_puskesmas','tbl_puskesmas', 'id');
		$this->forge->createTable('tbl_pendaftaran');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_pendaftaran');
	}
}
