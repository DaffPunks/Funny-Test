<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Users extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'person_type' => array(
                'type' => 'INT',
                'constraint' => 5
            ),
            'is_winner' => array(
                'type' => 'TINYINT'
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}