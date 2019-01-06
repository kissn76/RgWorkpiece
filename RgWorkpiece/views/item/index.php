<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'All Items'), ['index'], ['class' => 'btn btn-info btn-xs']) ?>
        <?= Html::a(Yii::t('app', 'Only Low'), ['indexlow'], ['class' => 'btn btn-info btn-xs']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model) {
                            if ($model->innumber <= 0) {    // There is no any incoming!
                                return ['class' => 'warning'];
                            }
                            
                            if ($model->itemActStock > $model->itemMinStock) {    // Stock is not 0
                                return ['class' => 'success'];
                            } else {
                                return ['class' => 'danger'];
                            }
                        },
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'itemId',
            //'itemCategory',
            [
                'attribute' => 'itemcategoryname',
                'value' => 'itemcategoryname.categoryName',
                'filter' => Html::activeDropDownList(
                                $searchModel,
                                'itemCategory',
                                ArrayHelper::map(Category::find()->orderBy(['categoryName' => SORT_ASC])->asArray()->all(), 'categoryId', 'categoryName'),
                                ['prompt' => Yii::t('app', 'Select Category') . '...']
                            ),
            ],
            'itemName:ntext',
            //'itemActStock',
            [
                'attribute' => 'itemActStock',
                'filter' => false,
            ],
            //'itemMinStock',
            [
                'attribute' => 'itemMinStock',
                'filter' => false,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {separator} {itemin} {itemout}', // custom buttons
                'buttons' => [
                    'separator' => function () {
                                    return '<span style="display: inline-block; width: 1em;"> </span>';
                                },
                    'itemin' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', Url::toRoute(['itemin/create', 'parentId' => $model->itemId]), ['title' => Yii::t('app', 'Add new incoming')]);
                                },
                    'itemout' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-paste"></span>', Url::toRoute(['itemout/create', 'parentId' => $model->itemId]), ['title' => Yii::t('app', 'Add new outgoing')]);
                                },
                ],
            ],
        ],
    ]); ?>
</div>
