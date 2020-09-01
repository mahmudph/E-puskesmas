<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLaporan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'int', 
				'constraint' => 6, 
				'null' => false, 
				'auto_increment' => true
			], 
			'id_puskesmas' => [
				'type' => 'int', 
				'constraint' => 6, 
				'null' => false, 
			], 
			'tgl_laporan' =>  [
				'type' =>'datetime', 
				'constraint' => 6
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('id_puskesmas','tbl_puskesmas', 'id');
		$this->forge->createTable('tbl_laporans');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_laporans');
	}
}
