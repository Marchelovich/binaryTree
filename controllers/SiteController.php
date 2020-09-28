<?php

namespace app\controllers;

use app\components\binaryTree\Node;
use app\components\binaryTree\TreeBuilder;
use app\models\Binary;
use app\models\NodeForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $nodeId = Yii::$app->request->get('nodeId');
        $nodeId = !empty($nodeId) && is_int($nodeId) ? $nodeId : Binary::ROOT_NODE_ID;
        $childrenDataProvider = new ArrayDataProvider([
            'models' => TreeBuilder::getChildren($nodeId),
        ]);
        $parentDataProvider = new ArrayDataProvider([
            'models' => TreeBuilder::getParent($nodeId),
        ]);

        return $this->render('index', [
            'childrenDataProvider' => $childrenDataProvider,
            'parentDataProvider' => $parentDataProvider,
            'nodeId' => $nodeId,
        ]);
    }

    public function actionBuildTree()
    {
        TreeBuilder::build5Levels();

        return $this->redirect(['index']);
    }

    public function actionAddNode()
    {
        $form = new NodeForm();

        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->validate()) {
            (new Node($form->parentId, $form->position))->add();

            return $this->redirect('index');
        }

        return $this->render('add_node', [
            'model' => $form,
        ]);
    }
}
