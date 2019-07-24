<?php

namespace app\components;

use Yii;
use yii\helpers\Html;
use kartik\grid\GridView;

class AppHelper {

    public static function getMasterActionColumn($template = '{update} {delete}') {
        return [
            'class' => 'kartik\grid\ActionColumn',
            'template' => $template,
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'header' => '',
            'buttons' => [
                'delete' => function ($url, $model) {
                    $url = ['delete', 'id' => $model->primaryKey];
                    $icon = 'trash';
                    $label = Yii::t('app', 'Delete');
                    $confirm = Yii::t('app', 'Are you sure you want to delete this data?');
                    return  Html::a("<span class='glyphicon glyphicon-$icon'></span>", $url, [
                                'title' => $label,
                                'aria-label' => $label,
                                'data-confirm' => $confirm,
                                'data-method' => 'post',
                                'data-pjax' => '0'
                    ]);
                },
                'update' => function ($url, $model) {
                    return  Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['update', 'id' => $model->primaryKey], [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'open-modal-btn'
                    ]);
                }
            ]
        ];
    }
}
