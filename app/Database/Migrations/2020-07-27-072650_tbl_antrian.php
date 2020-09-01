<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblAntrian extends Migration
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
			'id_pendaftaran' => [
				'type' => 'int',
				'constraint' => 6, 
				'null' => false,
			],
			'no_antrian' => [
				'type' => 'int',
				'constraint' => 15,
				'null' => false,
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_pendaftaran', 'tbl_pendaftarans', 'id');
		$this->forge->createTable('tbl_antrians');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_antrians');
	}
}
