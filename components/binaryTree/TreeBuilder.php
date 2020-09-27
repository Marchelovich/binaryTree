<?php

namespace app\components\binaryTree;

use app\models\Binary;
use yii\db\Expression;

class TreeBuilder
{
    /**
     * @return bool
     */
    public static function build5Levels(): bool
    {
        $parentIds = [Binary::ROOT_NODE_ID];

        for ($i = 1; $i < 5; $i++) {
            $parentIds = self::buildLevel($parentIds);
        }

        return true;
    }

    /**
     * @param array $parentIds
     * @return array
     */
    private static function buildLevel(array $parentIds): array
    {
        $levelNodeIds = [];
        foreach ($parentIds as $id) {
            $levelNodeIds = array_merge(self::addChildren($id), $levelNodeIds);
        }

        return $levelNodeIds;
    }

    /**
     * @param int $id
     * @return array
     */
    private static function addChildren(int $id): array
    {
        return [
            (new Node($id, 1))->add(),
            (new Node($id, 2))->add(),
        ];
    }

    /**
     * @param int $nodeId
     */
    public static function getChildren(int $nodeId)
    {
        $node = Binary::findOne($nodeId);
        if (null === $node) {
            return [];
        }
        $delimiter = Binary::PATH_DELIMITER;
        return Binary::find()
            ->where([
                'and',
                ['!=', 'id', $node->id],
                empty($node->path) ?: new Expression("path LIKE '{$node->path}{$delimiter}%'")
            ])
            ->orderBy([
                'path' => SORT_ASC,
                'position' => SORT_ASC,
            ])
            ->all();
    }

    /**
     * @param int $nodeId
     * @return Binary[]
     */
    public static function getParent(int $nodeId): array
    {
        $node = Binary::findOne($nodeId);
        if (null === $node) {
            return [];
        }

        return Binary::find()
            ->where(['id' => explode(Binary::PATH_DELIMITER, $node->path)])
            ->orderBy(['id' => SORT_ASC])
            ->all();
    }
}