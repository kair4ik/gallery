<?php

use yii\db\Migration;

/**
 * Class m180504_093556_folder
 */
class m180504_093556_folder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('folder', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180504_093556_folder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180504_093556_folder cannot be reverted.\n";

        return false;
    }
    */
}
