<?php


namespace app\models;

use yii\base\Model;

class NodeForm extends Model
{
    /** @var int */
    public $parentId;
    /** @var int */
    public $position;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentId', 'position'], 'integer'],
            [['parentId'], 'exist', 'targetClass' => Binary::class, 'targetAttribute' => 'id'],
            [['position'], 'in', 'range' => [Binary::POSITION_FIRS, Binary::POSITION_SECOND]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parentId' => 'Parent ID',
            'position' => 'Position',
        ];
    }
}