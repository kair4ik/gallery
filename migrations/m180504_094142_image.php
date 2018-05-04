<?php

use yii\db\Migration;

/**
 * Class m180504_094142_image
 */
class m180504_094142_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('image', [
			'id' => $this->primaryKey(),
			'title' => $this->string()->null(),
			'name' => $this->string()->null(),
			'description' => $this->string()->null(),
			'folder' => $this->string()->null(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180504_094142_image cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180504_094142_image cannot be reverted.\n";

        return false;
    }
    */
}
