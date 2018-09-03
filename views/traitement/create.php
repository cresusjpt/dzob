<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Traitement */
/* @var $modelT app\models\Traitement */

$this->title = Yii::t('app', 'Create Traitement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Traitements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traitement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelT'=>$modelT,
    ]) ?>

</div>
