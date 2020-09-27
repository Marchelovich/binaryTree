<?php

namespace app\components\binaryTree;

use app\models\Binary;
use RuntimeException;

class Node
{
    /** @var int */
    private $parentId;
    /** @var int */
    private $position;

    /**
     * @param int $parentId
     * @param int $position
     */
    public function __construct(int $parentId, int $position)
    {
        $this->parentId = $parentId;
        $this->position = $position;
    }

    /**
     * @return int|null
     */
    public function add(): ?int
    {
        $parent = Binary::findOne($this->parentId);
        if (null === $parent) {
            throw new RuntimeException('Parent node not found');
        }
        $node = Binary::findOne([
            'parent_id' => $this->parentId,
            'position' => $this->position,
        ]);
        if (null !== $node) {
            return $node->id;
        }

        $model = new Binary();
        $model->position = $this->position;
        $model->parent_id = $this->parentId;
        $model->level = $parent->level + 1;
        $model->path = $this->buildPath($parent->path);
        $model->save();

        return $model->id;
    }

    /**
     * @param string|null $parentPath
     * @returnint|string
     */
    public function buildPath(?string $parentPath): string
    {
        return empty($parentPath) ? $this->parentId : $parentPath . Binary::PATH_DELIMITER . $this->parentId;
    }
}