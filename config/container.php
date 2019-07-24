<?php

Yii::$container->set('kartik\grid\GridView', [
    'panel' => [
        'after' => false,
        //'before' => false
    ],
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'enablePushState' => false
        ]
    ],
    'responsiveWrap' => false,
    'resizableColumns' => false,
    'hover' => true,
]);

Yii::$container->set('kartik\select2\Select2', [
    'pluginLoading' => false,
]);