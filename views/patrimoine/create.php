<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Patrimoine */

$this->title = Yii::t('app', 'Ajouter Patrimoine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patrimoines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patrimoine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
