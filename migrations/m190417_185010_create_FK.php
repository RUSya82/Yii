<?php

use yii\db\Migration;

/**
 * Class m190417_185010_create_FK
 */
class m190417_185010_create_FK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_185010_create_FK cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_185010_create_FK cannot be reverted.\n";

        return false;
    }
    */
}
