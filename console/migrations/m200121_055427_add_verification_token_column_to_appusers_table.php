<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appusers}}`.
 */
class m200121_055427_add_verification_token_column_to_appusers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appusers}}', 'verification_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appusers}}', 'verification_token');
    }
}
