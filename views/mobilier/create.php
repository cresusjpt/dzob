<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mobilier */

$this->title = Yii::t('app', 'Create Mobilier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mobiliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobilier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
