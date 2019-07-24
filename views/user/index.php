<?php

use app\components\AppHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $model->search(),
        'panel' => [
            'heading' => '<h3 class="panel-title">' . $this->title . '</h3>',
            'type' => 'info',
            'before' => '',
            'after' => FALSE,
            'footer' => '',
        ],
        'filterModel' => FALSE,
        'responsiveWrap' => FALSE,
        'resizableColumns' => FALSE,
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                    'type' => 'button',
                    'title' => Yii::t('app', 'Add Bank'),
                    'class' => 'btn btn-primary open-modal-btn'
                ]) . ' ' .
                Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['index'], [
                    'class' => 'btn btn-default',
                    'title' => Yii::t('app', 'Refresh')
                ]),
            ],
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'hAlign' => 'center',
                'vAlign' => GridView::ALIGN_TOP,
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            'username',
            'email',
            //AppHelper::getMasterActionColumn()
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'header' => '',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        $url = ['delete', 'id' => $model['id']];
                        $icon = 'trash';
                        $label = Yii::t('app', 'Delete');
                        $confirm = Yii::t('app', 'Are you sure you want to delete this data?');
                        return Html::a("<span class='glyphicon glyphicon-$icon'></span>", $url, [
                                    'title' => $label,
                                    'aria-label' => $label,
                                    'data-confirm' => $confirm,
                                    'data-method' => 'post',
                                    'data-pjax' => '0'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['update', 'id' => $model['id']], [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'open-modal-btn'
                        ]);
                    }
                ]
            ],
        ],
    ]);
    ?>
    
</div>
