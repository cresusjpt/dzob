<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeCourrier */

$this->title = Yii::t('app', 'Créer Type Courrier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-courrier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
