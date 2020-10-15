<?php

use yii\db\Migration;

/**
 * Class m200121_055329_appuser
 */
class m200121_055329_appusers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%appusers}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);


        $this->addForeignKey('FK_id_user_interventions', 'interventions', 'id_user', 'appusers', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_id_it_user_tickets', 'tickets', 'id_it_user', 'appusers', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_id_user_interventions', 'interventions');
        $this->dropForeignKey('FK_id_it_user_tickets', 'tickets');
        $this->dropTable('{{%appusers}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200121_055329_appuser cannot be reverted.\n";

        return false;
    }
    */
}
