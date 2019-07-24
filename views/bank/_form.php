<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.file-preview-image {
    font: 40px Impact, Charcoal, sans-serif;
    color: #008000;
/*    height: 150px;*/
    width : 100%;
}

.kv-file-remove{
    visibility: hidden;
}
</style>

<div class="bank-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bank_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_email')->textInput() ?>

    <?php
        $imageUrl = \yii\helpers\Url::toRoute(['bank/get-image', 'fileName' => $model->bank_photo]);
        $deleteUrl = \yii\helpers\Url::toRoute(['bank/remove-image', 'id' => $model->bank_id ]);
        if ($model->bank_photo != NULL) {
            $initialPreview = [
                Html::img($imageUrl, ['class' => 'file-preview-image', 'alt' => $model->bank_photo, 'title' => $model->bank_photo])
            ];
            $initialPreviewConfig = [
                [
                    'url' => $deleteUrl,
                    'key' => $model->bank_photo,
                    'extra' => ['key' => $model->bank_photo],
                ]
            ];
        } else {
            $initialPreview = '';
            $initialPreviewConfig = '';
        }
    ?>
    
    <?=
    $form->field($model, 'temp')->widget(\kartik\file\FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'class' => 'temporary',
            'disabled' => FALSE,
        ],
        'pluginOptions' => [
            'removeLabel' => 'Delete',
            'cancelLabel' => 'Cancel',
            'showUpload' => false,
            'showCancel' => false,
            'showRemove' => false,
            'showCaption' => false,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig,
            'layoutTemplates' => [
                'main1' => '{preview}' .
                '<div class="kv-upload-progress hide"></div>' .
                '<div class="input-group {class}">' .
                '   {caption}' .
                '   <div class="input-group-btn">' .
                '       {browse}' .
                '   </div>' .
                '</div>',
                'preview' => '<div class="file-preview {class}">' .
                '    <div class="{dropClass}">' .
                '    <div class="file-preview-thumbnails">' .
                '    </div>' .
                '    <div class="clearfix"></div>' .
                '    <div class="file-preview-status text-center text-success"></div>' .
                '    <div class="kv-fileinput-error"></div>' .
                '    </div>' .
                '</div>']
        ],
    ])->hint('')
    ?> 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
