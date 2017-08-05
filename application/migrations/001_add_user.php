<?php
class Migration_Add_user extends CI_Migration
{
  public function up()
  {


    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 5,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'username' => array(
          'type' => 'VARCHAR',
          'constraint' => '50',
        ),
        'email' => array(
          'type' => 'varchar',
          'constraint' => '50',
          'null' => true,
        ),
        'password' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
        'created_in' => array(
          'type' => 'TIMESTAMP',
        ),
        'last_access' => array(
          'type' => 'TIMESTAMP',
        ),
        'status' => array(
          'type' => 'INT',
          'constraint' => 1,
          'default' => 1,
          'unsigned' => true,
        ),
      )
    );

    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users');


  }

  public function down()
  {
    $this->dbforge->drop_table('users');
  }
}

