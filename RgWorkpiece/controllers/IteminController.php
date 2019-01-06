<?php

namespace app\controllers;

use Yii;
use app\models\Itemin;
use app\models\IteminSearch;
use app\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IteminController implements the CRUD actions for Itemin model.
 */
class IteminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Itemin model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->parentItem = Item::findOne($model->iteminItem);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Itemin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parentId)
    {
        $model = new Itemin();
        $model->parentItem = Item::findOne($parentId);
        $model->iteminItem = $model->parentItem->itemId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->parentItem->itemActStock += $model->iteminAmount;
            $model->parentItem->save();
            return $this->redirect(['view', 'id' => $model->iteminId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Itemin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->parentItem = Item::findOne($model->iteminItem);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->iteminId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Itemin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $parentId = $model->iteminItem;
        $model->parentItem = Item::findOne($parentId);
        
        $model->parentItem->itemActStock -= $model->iteminAmount;
        
        $model->parentItem->save();
        
        $model->delete();

        return $this->redirect(['item/view', 'id' => $parentId]);
    }

    /**
     * Finds the Itemin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itemin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
