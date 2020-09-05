<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPengumuman extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 6,  'auto_increment' => true], 
			'judul' => ['type' => 'varchar', 'constraint' => 50],
			'tgl_pengumuman' =>  ['type' =>'datetime', 'constraint' => 6, 'null' =>false],
			'isi' => ['type' => 'text']
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('tbl_pengumumans');
		
	}

	public function down()
	{
		$this->forge->dropTable('tbl_pengumumans');
	}
}
