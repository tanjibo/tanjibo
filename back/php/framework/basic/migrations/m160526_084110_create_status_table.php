<?php

use yii\db\Migration;

/**
 * Handles the creation for table `status_table`.
 */
class m160526_084110_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('status_table', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('status_table');
    }
}
