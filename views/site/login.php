<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$bundle = yiister\gentelella\assets\Asset::register($this);
$this->registerCssFile('@web/assets_b/css/login.css');
?>

<style>

</style>

<div class="site-login">
    <div class="col-md-8 col-sm-12">
        <div class="panel panel-primary" id="panel-login" >
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('app', 'Notes') ?></h3>
            </div>
            <div class="row text-left">
                <div class="panel-body">
                    <b>Akses API</b><br><br>   
                    Module Bank<br>
                    <?= $url = yii\helpers\Url::base('http').'/api/v1/bank?access-token=auth_token'; ?> <br><br>
                    Module Pengguna<br>
                    <?= $url = yii\helpers\Url::base('http').'/api/v1/user?access-token=auth_token'; ?> <br><br>
                    
                    <table>
                        <tr>
                            <td>
                                <b>Akun Demo</b><br><br>
                                Administrator <br>
                                username :  admin <br>
                                password :  Abc123 <br>
                            </td>
                            <td style="padding-left: 20px;">
                                <br> <br>User <br>
                                username :  user <br>
                                password :  Abc123 <br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary" id="panel-login" >
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('app', 'Please Login') ?></h3>
            </div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'login-form',
            ]);
            ?>
            <div class="row">
                <div class="panel-body">
                    <h3 class="text-center"><?= Yii::$app->id ?> </h3>
                    <div class="col-md-12" style="margin-top: 20px;">
                        <?=
                        $form->field($model, 'username', [
                            'template' => "<div class=\"input-group input-group-lg\"><span class=\"input-group-addon\"><i class=\"fa fa-user\"></i></span>{input}</div>\n{hint}\n{error}",
                        ])->textInput(array('placeholder' => 'Username'))
                        ?>
                        <?=
                        $form->field($model, 'password', [
                            'template' => "<div class=\"input-group input-group-lg\"><span class=\"input-group-addon\"><i class=\"fa fa-lock\"></i></span>{input}</div>\n{hint}\n{error}",
                        ])->passwordInput(array('placeholder' => 'Password'))
                        ?>
                        <div class="pull-right">
                            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <br>
                        <span><?= Yii::$app->id ?> v.0.0.B</span>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>