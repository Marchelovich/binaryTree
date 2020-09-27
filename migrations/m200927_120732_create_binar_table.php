<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%binar}}`.
 */
class m200927_120732_create_binar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%binary}}', [
            'id' => $this->primaryKey(11),
            'parent_id' => $this->integer(11),
            'position' => $this->integer(11),
            'path' => $this->string(12228),
            'level' => $this->integer(11),
        ]);

        $this->createIndex(
            'nodeUnixIndx',
            '{{%binary}}',
            ['parent_id', 'position'],
            true
        );

        $this->insert('{{%binary}}', [
            /** @see \app\models\Binary::ROOT_NODE_ID */
            'id' => 1,
            'level' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%binary}}');
    }
}
