<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLaporanPasien extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 6, 'unsigned' => true, 'auto_increment' => true], 
			'id_laporan' => ['type' => 'int', 'constraint' => 6, 'null' =>false], 
			'id_pendaftar' =>  ['type' =>'int', 'constraint' => 6, 'null' =>false],
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('id_laporan','tbl_laporans', 'id');
		$this->forge->addForeignKey('id_pendaftar','tbl_pendaftarans', 'id');
		$this->forge->createTable('tbl_laporan_pasiens');
		
	}

	public function down()
	{
		$this->forge->dropTable('tbl_laporan_pasiens');
	}
}
