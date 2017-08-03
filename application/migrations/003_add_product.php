<?php
class Migration_Add_product extends CI_Migration
{
  public function up()
  {

    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 10,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'model' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'owner' => array(
          'type' => 'INT',
          'constraint' => 5,
        ),
        'cc' => array(
          'type' => 'VARCHAR',
          'constraint' => '100',
        ),
        'color' => array(
          'type' => 'INT',
          'unsigned' => true,
          'constraint' => 2,
        ),
        'price' => array(
          'type' => 'VARCHAR',
          'constraint' => '15',
        ),
        'image' => array(
          'type' => 'VARCHAR',
          'constraint' => '255',
        ),
      )
    );

    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('products');
  }

  public function down()
  {
    $this->dbforge->drop_table('products');
  }
}

