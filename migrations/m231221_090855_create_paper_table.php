<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%paper}}`.
 */
class m231221_090855_create_paper_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%paper}}', [
            'id' => $this->primaryKey(),
            'papername' => $this->string()->notNull()->unique(),
            'unit' => $this->string()->notNull()->unique(),
            'papercode' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->defaultValue(null),
          

           
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%paper}}');
    }
}
