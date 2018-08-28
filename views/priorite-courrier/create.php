<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PrioriteCourrier */

$this->title = Yii::t('app', 'Créer Priorite Courrier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priorite Courriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priorite-courrier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
