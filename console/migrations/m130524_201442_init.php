<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        //table setup options
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //table creation
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'account' => $this->string(30)->notNull()->unique(),
            'department' => $this->string(127)->notNull(),
            'location' => $this->string(10)->notNull(),
            'status' => $this->boolean()->notNull(), //Automatic, Default:Active, Values: Active, Inactive
        ], $tableOptions);

        $this->createTable('{{%tickets}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'ip_address' => $this->string(15)->notNull(), //Automatic: in app
            'priority' => $this->string(10)->notNull(), //Default: Normal, Values: Normal(implicit), Urgent, Prioritar
            'location' => $this->string(10)->notNull(),
            'problem' => $this->string(255)->notNull(),
            'date' => $this->date()->notNull(), //Default: Current date, current date when the ticket was created
            'status' => $this->string(10)->notNull(), //Default: Creat, Values:"Creat, "In Curs" and "Finalizat"
            'id_it_user' => $this->integer(), //UserId but only from the IT department(filter in app)
        ], $tableOptions);

        $this->createTable('{{%interventions}}', [
            'id' => $this->primaryKey(),
            'id_ticket' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'observation' => $this->string(255),
            'intervention' => $this->string(255)->notNull(),
            'date' => $this->date()->notNull(), //Default: Current date, current date when the intervention was logging
            'duration' => $this->integer()->notNull(), //minutes
        ], $tableOptions);

        //add foreign keys
        $this->addForeignKey('FK_id_user_tickets', 'tickets', 'id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_id_ticket_tickets', 'interventions', 'id_ticket', 'tickets', 'id', 'CASCADE', 'CASCADE');
        
    }

    public function safeDown()
    {
        //drop foreign keys
        $this->dropForeignKey('FK_id_user_tickets', 'tickets');
        $this->dropForeignKey('FK_id_ticket', 'interventions');

        //drop tables
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%tickets}}');
        $this->dropTable('{{%interventions}}');
    }
}
