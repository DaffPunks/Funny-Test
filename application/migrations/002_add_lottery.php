<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Lottery extends CI_Migration
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
            'date' => array(
                'type' => 'DATE'
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'null' => true
            ),
            'have_winner' => array(
                'type' => 'TINYINT',
                'default' => false
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('lottery');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}