<?php
class Migration_Add_session extends CI_Migration
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
        'ip_address' => array(
          'type' => 'VARCHAR',
          'constraint' => '20',
        ),
        'timestamp' => array(
          'type' => 'TIMESTAMP',
        ),
        'uid' => array(
          'type' => 'INT',
          'constraint' => 5,
          'unsigned' => true,
        ),
      )
    );

    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('ci_session');


  }

  public function down()
  {
    $this->dbforge->drop_table('ci_session');
  }
}

