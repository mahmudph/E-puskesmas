<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPuskesmas extends Migration
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
			'nama_puskesmas' => [
				'type' => 'varchar',
				'constraint' => 50,
				'null' => false,
			],
			'alamat_puskesmas' => [
				'type' => 'text',
				'null' => false,
			],
			'admin_puskesmas' => [
				'type' => 'int',
				'constraint' => 6,
				'null' => false,
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('admin_puskesmas', 'tbl_user', 'id');
		$this->forge->createTable('tbl_puskesmas');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_puskesmas');
	}
}
