<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $position
 * @property string|null $path
 * @property int|null $level
 *
 * @property-read Binary|null $parent
 */
class Binary extends ActiveRecord
{
    public const POSITION_FIRS = 1;
    public const POSITION_SECOND = 2;

    public const ROOT_NODE_ID = 1;

    public const PATH_DELIMITER = '.';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'binary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'position', 'level'], 'integer'],
            ['parent_id', 'required', 'when' => function (self $model): bool {
                return $model->level > 1;
            }],
            [['level'], 'integer', 'min' => 1],
            [['parent_id'], 'exist', 'targetClass' => self::class, 'targetAttribute' => 'id'],
            [['position'], 'in', 'range' => [self::POSITION_FIRS, self::POSITION_SECOND]],
            [['path'], 'string', 'max' => 12228],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'position' => 'Position',
            'path' => 'Path',
            'level' => 'Level',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }
}
