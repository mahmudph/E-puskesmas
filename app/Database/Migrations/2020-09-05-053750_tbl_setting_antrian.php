<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSettingAntrian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 6, 'auto_increment' => true], 
			'id_puskes' => ['type' => 'int', 'constraint' => 6], 
			'jmlh_antrian' => ['type' => 'int', 'constraint' => 6], 
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('id_puskes','tbl_puskesmas', 'id');
		$this->forge->createTable('tbl_setting_antrians');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_setting_antrians');
	}
}
