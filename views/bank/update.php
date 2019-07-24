<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */

$this->title = Yii::t('app', 'Update Bank: {name}', [
    'name' => $model->bank_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bank_id, 'url' => ['view', 'id' => $model->bank_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bank-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
