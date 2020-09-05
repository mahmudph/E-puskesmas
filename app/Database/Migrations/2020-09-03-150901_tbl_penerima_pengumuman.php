<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPenerimaPengumuman extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 6, 'auto_increment' => true], 
			'id_puskes' => ['type' => 'int', 'constraint' => 6], 
			'id_pengumuman' => ['type' => 'int', 'constraint' => 6], 
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('id_puskes','tbl_puskesmas', 'id');
		$this->forge->addForeignKey('id_pengumuman','tbl_pengumumans', 'id');
		$this->forge->createTable('tbl_penerima_pengumumans');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_penerima_pengumumans');
	}
}
