<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'auto_increment' => true,
            ],
            'nama'   => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '50',
            ],
            'jenis_kelamin' => [
                    'type'           => 'CHAR',
                    'null'           => false,
            ],
            'tanggallahir' => [
                    'type'           => 'DATETIME',
                    'null'           => false,
            ],
            'alamat' 	=> [
                    'type'           => 'TEXT',
                    'null'           => false,
            ],
		]);

                        
	    $this->forge->addKey('id', true);
        $this->forge->createTable('user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
