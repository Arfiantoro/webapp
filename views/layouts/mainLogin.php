<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = yiister\gentelella\assets\Asset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->id ?> - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        @media (min-width:992px) {
            .container{
                padding-top: 100px !important;
            }
        }

        @media (max-width:991px) {
            .container{
                padding-top: 20px !important;
            }
        }
    </style>
</head>
<body class="login-page">
    <?php $this->beginBody() ?>
    <div class="wrap">
        <div class="container">
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
