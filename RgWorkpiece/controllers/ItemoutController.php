<?php

namespace app\controllers;

use Yii;
use app\models\Itemout;
use app\models\ItemoutSearch;
use app\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemoutController implements the CRUD actions for Itemout model.
 */
class ItemoutController extends Controller
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
     * Displays a single Itemout model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->parentItem = Item::findOne($model->itemoutItem);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Itemout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parentId)
    {
        $model = new Itemout();
        $model->parentItem = Item::findOne($parentId);
        $model->itemoutItem = $model->parentItem->itemId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->parentItem->itemActStock -= $model->itemoutAmount;
            $model->parentItem->save();
            return $this->redirect(['view', 'id' => $model->itemoutId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Itemout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->parentItem = Item::findOne($model->itemoutItem);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->itemoutId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Itemout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $parentId = $model->itemoutItem;
        $model->parentItem = Item::findOne($parentId);
        
        $model->parentItem->itemActStock += $model->itemoutAmount;
        
        $model->parentItem->save();
        
        $model->delete();

        return $this->redirect(['item/view', 'id' => $parentId]);
    }

    /**
     * Finds the Itemout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Itemout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
